<?php

include __DIR__."/../config/database.php";

class User{

function login($username,$password){

global $conn;

$pass = md5($password);

$query = $conn->query("SELECT * FROM users 
WHERE username='$username' 
AND password='$pass'");

return $query->fetch_assoc();

}

}

?>