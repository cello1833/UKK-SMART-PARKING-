<?php
include "config/database.php";

$id = $_GET['id'] ?? 0;

$q = $conn->query("SELECT * FROM transaksi WHERE id='$id'");
$data = $q->fetch_assoc();

if(!$data){
    echo "Data tidak ditemukan";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Struk Parkir</title>
    <style>
        body{
            font-family: monospace;
            width: 300px;
            margin: auto;
        }
        .struk{
            border: 1px dashed black;
            padding: 10px;
        }
        h3{
            text-align: center;
        }
    </style>
</head>
<body onload="window.print()">

<div class="struk">

<h3>SMART PARKING</h3>
<hr>

<p>ID Kartu : <?= $data['card_id'] ?></p>
<p>Masuk    : <?= $data['checkin_time'] ?></p>
<p>Keluar   : <?= $data['checkout_time'] ?></p>
<p>Durasi   : <?= $data['duration'] ?> menit</p>
<p>Biaya    : Rp <?= number_format($data['fee']) ?></p>

<hr>
<p style="text-align:center;">Terima Kasih</p>

</div>

</body>
</html>