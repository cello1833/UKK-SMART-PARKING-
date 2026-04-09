<?php
include "../config/database.php";

/* kendaraan sedang parkir */
$data = $conn->query("SELECT * FROM transaksi WHERE status='IN'");

/* kendaraan untuk checkout */
$keluar = $conn->query("SELECT * FROM transaksi WHERE status='DONE'");

/* riwayat parkir */
$riwayat = $conn->query("SELECT * FROM transaksi WHERE status='OUT'");
?>