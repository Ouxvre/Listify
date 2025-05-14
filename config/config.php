<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "listify";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>