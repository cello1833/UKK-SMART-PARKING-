<?php
include "../controllers/DashboardController.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard Smart Parking</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: #f1f5f9; /* abu muda */
    color: #1e293b;
    font-family: 'Segoe UI', sans-serif;
}

/* HEADER */
.header-box {
    padding: 15px 0;
    border-bottom: 1px solid #e2e8f0;
    margin-bottom: 20px;
}

h3 {
    margin: 0;
    font-weight: 600;
    color: #0f172a;
}

/* STAT */
.stat-box h6 {
    color: #64748b;
    margin: 0;
}
.stat-box h4 {
    margin: 0;
    font-weight: bold;
    color: #0f172a;
}

/* SECTION TITLE */
.section-title {
    margin-top: 30px;
    margin-bottom: 10px;
    font-weight: 600;
    color: #2563eb; /* biru */
}

/* TABLE */
.table {
    border-radius: 12px;
    overflow: hidden;
    background: #ffffff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

/* HEADER TABLE */
.table th {
    background: linear-gradient(90deg, #3b82f6, #06b6d4);
    color: #ffffff;
    border: none;
    font-weight: 500;
}

/* ISI TABLE */
.table td {
    background: #ffffff;
    color: #1e293b;
    border-color: #e2e8f0;
}

/* ZEBRA */
.table tr:nth-child(even) td {
    background: #f8fafc;
}

/* HOVER */
.table tr:hover td {
    background: #e0f2fe;
    transition: 0.2s;
}

/* BUTTON */
.btn {
    border-radius: 8px;
    padding: 6px 12px;
}

/* OPTIONAL BUTTON WARNA */
.btn-primary {
    background: #3b82f6;
    border: none;
}

.btn-success {
    background: #22c55e;
    border: none;
}

.btn-danger {
    background: #ef4444;
    border: none;
}
</style>
</head>

<body>

<div class="container mt-4">

<!-- HEADER -->
<div class="header-box d-flex justify-content-between align-items-center">
    <h3>Smart Parking Dashboard</h3>
   
</div>



<!-- CHECK IN -->
<div class="section-title">Check In Kendaraan</div>

<table class="table text-center mb-4">
<thead>
<tr>
<th>Card ID</th>
<th>Check In</th>
<th>Status</th>
</tr>
</thead>

<tbody>
<?php while($row = $data->fetch_assoc()){ ?>
<tr>
<td><b><?= $row['card_id'] ?></b></td>
<td><?= date('d-m-Y H:i', strtotime($row['checkin_time'])) ?></td>
<td><span class="badge bg-primary"><?= $row['status'] ?></span></td>
</tr>
<?php } ?>
</tbody>
</table>

<!-- CHECK OUT -->
<div class="section-title">Check Out Kendaraan</div>

<table class="table text-center mb-4">
<tr>
<th>Card ID</th>
<th>Check In</th>
<th>Aksi</th>
</tr>

<?php while($k=$keluar->fetch_assoc()){ ?>
<tr>
<td><b><?= $k['card_id']?></b></td>
<td><?= date('d-m-Y H:i', strtotime($k['checkin_time'])) ?></td>
<td>
<a href="../buka_palang.php?id=<?=$k['id']?>" 
class="btn btn-success btn-sm">
 Buka Palang
</a>
</td>
</tr>
<?php } ?>
</table>

<!-- RIWAYAT -->
<div class="section-title">Riwayat Parkir</div>

<table class="table text-center">

<tr>
<th>Card ID</th>
<th>Check In</th>
<th>Check Out</th>
<th>Durasi</th>
<th>Biaya</th>
<th>Struk</th>
</tr>

<?php while($r=$riwayat->fetch_assoc()){ ?>
<tr>
<td><b><?= $r['card_id']?></b></td>
<td><?= date('d-m-Y H:i', strtotime($r['checkin_time'])) ?></td>
<td><?= date('d-m-Y H:i', strtotime($r['checkout_time'])) ?></td>

<td>
<?php 
if($r['duration'] < 60){
    echo $r['duration']." menit";
} else {
    echo ceil($r['duration']/60)." jam";
}
?>
</td>

<td><b>Rp <?= number_format($r['fee'],0,',','.') ?></b></td>

<td>
<a href="../struk.php?id=<?=$r['id']?>" 
class="btn btn-primary btn-sm">
 Struk
</a>
</td>
</tr>
<?php } ?>

</table>
 <a href="../views/login.php" class="btn btn-danger btn-sm">Logout</a>
</div>

</body>
</html>