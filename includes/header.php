<?php
// Pastikan file ini dipanggil di index.php dengan: include 'header.php';

date_default_timezone_set('Asia/Jakarta');

$bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
$hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];

$now = new DateTime();
$formattedDate = $now->format('j') . ' ' . $bulan[(int)$now->format('n') - 1] . ' ' . $now->format('Y');
$hariSekarang = $hari[(int)$now->format('w')]; // 0 (Minggu) - 6 (Sabtu)

// Last update: jam sekarang dikurangi 5 menit
$lastUpdate = (clone $now)->modify('-0 minutes')->format('H:i');
?>
<header class="glass-header">
    <div class="header-content">
        <div class="header-left">
            <img src="includes/images/logo.png" alt="Logo RS" style="height:40px;">
            <h1>Informasi Praktek Dokter <?= $hariSekarang; ?>, <?= $formattedDate; ?></h1>
            <h2>Last Update : <?= $lastUpdate; ?></h2>
        </div>
        <!-- <span class="hari"><?= $hariSekarang; ?></span> -->
    </div>
</header>
