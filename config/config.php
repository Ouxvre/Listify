<?php

// Konfigurasi Database MySQL (MySQLi)
$servername = "localhost";
$username = "root";
$password = "";
$database = "aethra";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}
?>