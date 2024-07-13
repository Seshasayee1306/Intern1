<?php
$servername = "localhost";
$username = "root";  // XAMPP default
$password = "Prabhabala##70";      // XAMPP default
$dbname = "demat_system";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
