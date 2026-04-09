<?php
date_default_timezone_set('Asia/Jakarta');

require_once("phpMQTT.php");
use Bluerhinos\phpMQTT;

include "../config/database.php";

$server = "broker.hivemq.com";
$port = 1883;
$client_id = "phpMQTT-subscriber";

$mqtt = new phpMQTT($server,$port,$client_id);

if(!$mqtt->connect()){
    exit(1);
}

echo "Connected to broker\n";

// FIX TOPIC
$topics['parking/KELOMPOK0122/entry/rfid'] = array("qos"=>0,"function"=>"procmsg");
$topics['parking/KELOMPOK0122/exit/rfid'] = array("qos"=>0,"function"=>"procmsg");


$mqtt->subscribe($topics,0);

while($mqtt->proc()){
}

$mqtt->close();


function procmsg($topic, $msg){

global $conn;

$data = json_decode($msg, true);
$card = $data['rfid'] ?? '';

if($card == '') return;


// ================= ENTRY =================
if(strpos($topic, 'entry') !== false){

    $conn->query("INSERT INTO transaksi(card_id,checkin_time,status)
    VALUES('$card',NOW(),'IN')");

    echo "CHECKIN\n";
}


// ================= EXIT =================
elseif(strpos($topic, 'exit') !== false){

$q = $conn->query("SELECT * FROM transaksi 
WHERE card_id='$card' AND status='IN'
ORDER BY id DESC LIMIT 1");

if($q->num_rows > 0){

$row = $q->fetch_assoc();
$id = $row['id'];

$conn->query("UPDATE transaksi 
SET status='DONE'
WHERE id='$id'");

echo "MENUNGGU PETUGAS\n";

} else {
echo "DATA TIDAK ADA\n";
}
}
}