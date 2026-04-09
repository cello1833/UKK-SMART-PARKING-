<?php
session_start();

include "../models/User.php";

$user = new User();

$data = $user->login($_POST['username'],$_POST['password']);

if($data){

$_SESSION['login']=true;

header("Location: ../views/dashboard.php");

}else{

echo "Login gagal";

}

?>