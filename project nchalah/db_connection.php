<?php
$servername = "localhost";  // Replace with your database server name
$username = "root";     // Replace with your database username
$password = "";     // Replace with your database password
$dbname = "next_step_student";  // Replace with your database name

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>