<?php

$conn = new mysqli("localhost","root","","parkir_iot");

if($conn->connect_error){
 die("Koneksi gagal");
}

?>