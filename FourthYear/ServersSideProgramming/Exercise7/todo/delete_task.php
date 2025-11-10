<?php
require_once 'db.php';
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $stmt = $conn->prepare("DELETE FROM tasks WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
