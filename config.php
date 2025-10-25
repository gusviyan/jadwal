<?php
require __DIR__ . '/vendor/autoload.php';

// Lokasi file kredensial service account Google
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/credentials.json');

// Inisialisasi client Google API
$client = new Google\Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google\Service\Sheets::SPREADSHEETS_READONLY);

$service = new Google\Service\Sheets($client);

// ID Spreadsheet dari Google Sheets kamu
$spreadsheetId = '1DpjYsqJ7oWE92xlaBkim7xtUy_quRb8MsNgLmV7BmwA';

// Mapping hari Indonesia
$hariInggris = date('l');
$mapHari = [
    'Monday'    => 'Senin',
    'Tuesday'   => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday'  => 'Kamis',
    'Friday'    => 'Jumat',
    'Saturday'  => 'Sabtu',
    'Sunday'    => 'Minggu'
];
$hariSekarang = $mapHari[$hariInggris];

// Ambil data dari sheet berdasarkan hari ini
$range = $hariSekarang . '!A1:D';

try {
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
} catch (Exception $e) {
    $values = [];
    $error = "Gagal mengambil data: " . $e->getMessage();
}
