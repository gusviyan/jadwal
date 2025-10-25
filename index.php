<?php
include 'config.php';
include 'header.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Jadwal Dokter</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

    <main class="grid-container">
        <?php if (!empty($error)): ?>
            <div class="error"><?= $error; ?></div>
        <?php elseif (empty($values) || count($values) <= 1): ?>
            <p class="no-data">Tidak ada data jadwal untuk hari ini.</p>
        <?php else: ?>
            <?php for ($i = 1; $i < count($values); $i++): ?>
                <?php
                    $nama = $values[$i][0] ?? '';
                    $spesialis = $values[$i][1] ?? '';
                    $mulai = $values[$i][2] ?? '';
                    $selesai = $values[$i][3] ?? '';
                ?>
                <div class="card">
                    <h2><?= htmlspecialchars($nama); ?></h2>
                    <p class="spesialis"><?= htmlspecialchars($spesialis); ?></p>
                    <p class="jam"><?= htmlspecialchars($mulai . ' - ' . $selesai); ?></p>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </main>

<?php include 'footer.php'; ?>

</body>
</html>
