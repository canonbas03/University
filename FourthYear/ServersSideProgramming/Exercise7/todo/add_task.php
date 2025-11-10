<?php
require_once "db.php";
$title = $_POST["title"] ?? "";
$priority = $_POST["priority"] ?? "";
$deadline = $_POST["deadline"] ?? "";

if (!empty($title) && !empty($deadline)) {
    $stmt = $conn->prepare("INSERT INTO tasks (title, priority, deadline) VALUES(?, ?, ?)");
    $stmt->bind_param("sis", $title, $priority, $deadline);
    $insert = $stmt->execute();
    $stmt->close();
    if ($insert)
        echo "Successfully added a task";
    else
        echo "Something is wrong while addinng a task";
} else
    echo  "Fill all the fields!";
