<?php
require_once "../db.php"; // your mysqli connection

$title = $_POST['title'] ?? '';
$author = $_POST['author'] ?? '';
$year = $_POST['year'] ?? '';
$total_copies = $_POST['total_copies'] ?? '';

if (
    !empty($title) &&
    !empty($author) &&
    is_numeric($year) &&
    is_numeric($total_copies) &&
    $total_copies > 0
) {
    $stmt = $conn->prepare("INSERT INTO books (title, author, year, total_copies, available_copies) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiii", $title, $author, $year, $total_copies, $total_copies);
    $stmt->execute();
    $stmt->close();
    echo "Книгата е добавена успешно!";
} else {
    echo "Попълнете всички полета правилно.";
}
