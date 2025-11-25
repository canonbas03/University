<?php
require_once "../db.php";

$reader = $_POST["reader"] ?? "";
$book_title = $_POST["book_title"] ?? "";

if (empty($reader) || empty($book_title)) {
    echo "Попълнете всички полета!";
    exit;
}


$stmt = $conn->prepare("SELECT id, available_copies FROM books WHERE title = ?");
$stmt->bind_param("s", $book_title);
safeExecute($stmt);
$stmt->store_result();
if ($stmt->num_rows === 0) {
    echo "Книгата не съществува!";
    exit;
}
$stmt->bind_result($book_id, $available_copies);
$stmt->fetch();
$stmt->close();

if ($available_copies <= 0) {
    echo "Всички копия са заети!";
    exit;
}


$newAvailableCopies = $available_copies - 1;
$updateStmt = $conn->prepare("UPDATE books SET available_copies = ? WHERE id = ?");
$updateStmt->bind_param("ii", $newAvailableCopies, $book_id);
safeExecute($updateStmt);
$updateStmt->close();

$insertStmt = $conn->prepare("INSERT INTO borrowed (reader, book_id, date_taken) VALUES (?, ?, NOW())");
$insertStmt->bind_param("si", $reader, $book_id);
safeExecute($insertStmt);
$insertStmt->close();

echo "Book borrowed successfully!";

// --- HELPER FUNCTIONS
function safeExecute($stmt)
{
    if (!$stmt->execute()) {
        die("Грешка при изпълнение на заявката.");
    }
}
