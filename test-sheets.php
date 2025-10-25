<?php
require __DIR__ . '/vendor/autoload.php';

// ID spreadsheet kamu (contoh)
$spreadsheetId = '1DpjYsqJ7oWE92xlaBkim7xtUy_quRb8MsNgLmV7BmwA'; 

// Tentukan sheet berdasarkan hari (Senin, Selasa, Rabu, dst)
$hari_ini = date('l');
$nama_sheet = '';
switch ($hari_ini) {
    case 'Monday': $nama_sheet = 'Senin'; break;
    case 'Tuesday': $nama_sheet = 'Selasa'; break;
    case 'Wednesday': $nama_sheet = 'Rabu'; break;
    case 'Thursday': $nama_sheet = 'Kamis'; break;
    case 'Friday': $nama_sheet = 'Jumat'; break;
    case 'Saturday': $nama_sheet = 'Sabtu'; break;
    case 'Sunday': $nama_sheet = 'Minggu'; break;
}

// Load service account credentials
$client = new Google\Client();
$client->setAuthConfig(__DIR__ . '/credentials.json');
$client->addScope(Google\Service\Sheets::SPREADSHEETS_READONLY);

$service = new Google\Service\Sheets($client);

// Range data
$range = $nama_sheet . '!A2:D'; // Ambil kolom A-D mulai dari baris 2
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

// Cek data
if (empty($values)) {
    echo "Tidak ada data di sheet $nama_sheet";
} else {
    echo "<h2>Jadwal Dokter — Hari Ini ($nama_sheet)</h2>";
    echo "<table border='1' cellpadding='8' cellspacing='0'>";
    echo "<tr><th>Dokter</th><th>Spesialis</th><th>Mulai</th><th>Akhir</th></tr>";

    foreach ($values as $row) {
        echo "<tr>";
        echo "<td>{$row[0]}</td>"; // Dokter
        echo "<td>{$row[1]}</td>"; // Spesialis
        echo "<td>{$row[2]}</td>"; // Mulai
        echo "<td>{$row[3]}</td>"; // Akhir
        echo "</tr>";
    }

    echo "</table>";
}
?>
