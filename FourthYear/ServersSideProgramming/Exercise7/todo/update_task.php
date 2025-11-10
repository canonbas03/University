<?php
require_once 'db.php';

if (isset($_POST["id"]) && isset($_POST["title"]) && isset($_POST["priority"]) && isset($_POST["deadline"])) {

    $id = $_POST["id"];
    $title = $_POST["title"];
    $priority = $_POST["priority"];
    $deadline = $_POST["deadline"];

    $stmt = $conn->prepare("UPDATE tasks SET title = ?, priority = ?, deadline = ? WHERE id = ?");

    $stmt->bind_param("sisi", $title, $priority, $deadline, $id);

    if ($stmt->execute()) {
        echo "Task updated successfully!";
    } else {
        echo "Error updating task!";
    }

    $stmt->close();
}
