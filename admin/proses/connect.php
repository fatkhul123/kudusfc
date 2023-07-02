<?php
$servername = "db4free.net"; // Replace with the correct server name
$username = "fatkhul"; // Replace with your database username
$password = "Fatkhul_01"; // Replace with your database password
$dbname = "db_club"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
