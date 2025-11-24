<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gallery_db37";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error)
    die("Грешка при свързване!");
