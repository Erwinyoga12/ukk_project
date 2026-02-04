<?php

$host       = "localhost";
$database   ="db_fortopolio";
$user       ="root";
$password   ="";
$port       ="3306";


$conn = mysqli_connect($host, $user, $password, $database);

if(!$conn){
    die('Gagal terhubung ke database');
}


$username = mysqli_real_escape_string($conn,$_POST['username']);
$password = mysqli_real_escape_string ($conn,$_POST['password']);

$query = "select username, password from user where username='".$username."' and password='".$password."' ";

$hasil = mysqli_query($conn,$query);
$data = mysqli_fetch_array($hasil);

if($data){
    header("location:index.php");
}else{
    header("location:login.php");
}

?>