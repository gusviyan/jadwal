<?php
// Pastikan file ini dipanggil di index.php dengan: include 'header.php';
?>
<?php
$bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
$now = new DateTime();
$formattedDate = $now->format('j') . ' ' . $bulan[(int)$now->format('n') - 1] . ' ' . $now->format('Y');
?>
<header class="glass-header">
    <div class="header-content">
        <div class="header-left">
            <img src="logo.png" alt="Logo RS" style="height:40px;">
            <h1>Informasi Praktek Dokter <?= $hariSekarang; ?>, <?= $formattedDate; ?></h1>
        </div>
        <!-- <span class="hari"><?= $hariSekarang; ?></span> -->
    </div>
</header>
