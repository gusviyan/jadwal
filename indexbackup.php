<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Jadwal Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f1f5f9;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background: #2563eb;
        }
        .navbar-brand {
            color: white !important;
            font-weight: 600;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .table th {
            background-color: #3b82f6;
            color: white;
        }
        .table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg px-4">
    <a class="navbar-brand" href="#">🩺 Jadwal Dokter</a>
</nav>

<div class="container my-5">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0 text-primary">Jadwal Dokter Hari Ini</h4>
            <span class="badge bg-secondary fs-6"><?= $hariSekarang; ?></span>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php elseif (empty($values) || count($values) <= 1): ?>
            <p class="text-muted">Tidak ada data jadwal untuk hari ini.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th>Nama Dokter</th>
                            <th>Spesialis</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 1; $i < count($values); $i++): ?>
                            <tr>
                                <td><?= $values[$i][0] ?? ''; ?></td>
                                <td><?= $values[$i][1] ?? ''; ?></td>
                                <td><?= $values[$i][2] ?? ''; ?></td>
                                <td><?= $values[$i][3] ?? ''; ?></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
