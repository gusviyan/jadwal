<?php
require __DIR__ . '/vendor/autoload.php';

// Path ke file credentials.json
putenv('GOOGLE_APPLICATION_CREDENTIALS=' . __DIR__ . '/credentials.json');

// Inisialisasi client Google API
$client = new Google\Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google\Service\Sheets::SPREADSHEETS_READONLY);

$service = new Google\Service\Sheets($client);

// ID spreadsheet kamu
$spreadsheetId = '1DpjYsqJ7oWE92xlaBkim7xtUy_quRb8MsNgLmV7BmwA';

// Ambil hari ini (dalam Bahasa Indonesia)
$hariInggris = date('l'); // Sunday, Monday, ...
$mapHari = [
    'Monday' => 'Senin',
    'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu',
    'Thursday' => 'Kamis',
    'Friday' => 'Jumat',
    'Saturday' => 'Sabtu',
    'Sunday' => 'Minggu'
];
$hariSekarang = $mapHari[$hariInggris];

// Tentukan nama sheet sesuai hari
$range = $hariSekarang . '!A1:D';

try {
    // Ambil data dari Google Sheets
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $values = $response->getValues();
} catch (Exception $e) {
    die("Gagal mengambil data dari sheet <b>$hariSekarang</b>: " . $e->getMessage());
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Dokter Hari Ini</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f1f5f9;
            margin: 0;
            padding: 20px;
        }
        .card {
            background-color: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 900px;
            margin: auto;
        }
        h2 {
            color: #1e3a8a;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #e2e8f0;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #3b82f6;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .hari {
            color: #64748b;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>🩺 Jadwal Dokter Hari Ini</h2>
        <p class="hari">Hari: <strong><?= $hariSekarang; ?></strong></p>

        <?php if (empty($values) || count($values) <= 1): ?>
            <p>Tidak ada data ditemukan untuk hari ini.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Nama Dokter</th>
                    <th>Spesialis</th>
                    <th>Mulai</th>
                    <th>Akhir</th>
                </tr>
                <?php for ($i = 1; $i < count($values); $i++): ?>
                    <tr>
                        <td><?= $values[$i][0] ?? ''; ?></td>
                        <td><?= $values[$i][1] ?? ''; ?></td>
                        <td><?= $values[$i][2] ?? ''; ?></td>
                        <td><?= $values[$i][3] ?? ''; ?></td>
                    </tr>
                <?php endfor; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
