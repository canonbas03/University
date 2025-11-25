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
    $titleStmt = $conn->prepare("SELECT id FROM books WHERE title = ?");
    $titleStmt->bind_param("s", $title);
    $titleStmt->execute();
    $titleStmt->store_result();
    if ($titleStmt->num_rows > 0) {
        $sql = "
        UPDATE books 
        SET total_copies = total_copies + ?, available_copies = available_copies + ? 
        WHERE title = ?
        ";
        $updateStmt = $conn->prepare($sql);
        $updateStmt->bind_param("iis", $total_copies, $total_copies, $title);
        $updateStmt->execute();
        $updateStmt->close();
    } else {
        $stmt = $conn->prepare("INSERT INTO books (title, author, year, total_copies, available_copies) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiii", $title, $author, $year, $total_copies, $total_copies);
        $stmt->execute();
        $stmt->close();
    }

    echo "Книгата е добавена успешно!";
} else {
    echo "Попълнете всички полета правилно.";
}
