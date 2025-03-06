<?php
if(isset($_GET['email'])){
    $o=true;
    $email=$_GET['email'];
    $mysqli = new mysqli("localhost", "root", "", "isima");
    $mysqli -> set_charset("utf8");
    if($mysqli->connect_error){
    die("connection failed: ". $mysqli->connect_error);
    }
}
else{
$mysqli = new mysqli("localhost", "root", "", "isima");
$mysqli -> set_charset("utf8");
if($mysqli->connect_error){
die("connection failed: ". $mysqli->connect_error);
}
$o=false;
}
?>