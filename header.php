<?php
// Pastikan file ini dipanggil di index.php dengan: include 'header.php';
?>
<header class="glass-header">
    <div class="header-content">
        <div class="header-left">
    <img src="logo.png" alt="Logo RS" style="height:40px;">
            <h1>Praktek Dokter Hari Ini (<?= date('d/m/Y'); ?>)</h1>
        </div>
        <span class="hari"><?= $hariSekarang; ?></span>
    </div>
</header>
