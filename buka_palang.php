<?php
date_default_timezone_set('Asia/Jakarta');
include "config/database.php";

$id = $_GET['id'];

$q = $conn->query("SELECT * FROM transaksi WHERE id='$id'");
$row = $q->fetch_assoc();

$masuk = strtotime($row['checkin_time']);
$keluar = time();

$selisih = $keluar - $masuk;

if($selisih < 0){
    $selisih = 0;
}

$durasi = ceil($selisih / 60); // durasi dalam menit

if ($selisih < 1){
    $durasi = 1;
}

// tarif parkir
$tarif = 2000;

// hitung biaya per jam
$biaya = ceil($durasi / 60) * $tarif;

// minimal bayar 2000
if($biaya < 2000){
    $biaya = 2000;
}
// UPDATE
$conn->query("UPDATE transaksi SET
    checkout_time = NOW(),
    duration = '$durasi',
    fee = '$biaya',
    status = 'OUT'
WHERE id='$id'");

// MQTT
require_once("mqtt/phpMQTT.php");
use Bluerhinos\phpMQTT;

$mqtt = new phpMQTT("broker.hivemq.com",1883,"server");

if($mqtt->connect()){

    // buka palang
    $mqtt->publish("parking/KELOMPOK0122/exit/servo","OPEN",0);

    // tampilkan harga di LCD
    $mqtt->publish("parking/KELOMPOK0122/lcd","Bayar: Rp ".$biaya,0);

    $mqtt->close();
}

header("Location: views/dashboard.php");