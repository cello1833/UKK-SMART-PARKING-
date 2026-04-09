<?php

include __DIR__."/../config/database.php";

class Transaksi{

function parkir(){

global $conn;

return $conn->query("SELECT * FROM transaksi WHERE status='IN'");

}

function keluar(){

global $conn;

return $conn->query("SELECT * FROM transaksi WHERE status='OUT'");

}

function riwayat(){

global $conn;

return $conn->query("SELECT * FROM transaksi WHERE status='DONE'");

}

}

?>