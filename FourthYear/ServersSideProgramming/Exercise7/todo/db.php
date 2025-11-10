<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "todo_db36";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
} else
    echo "Connected to db";
