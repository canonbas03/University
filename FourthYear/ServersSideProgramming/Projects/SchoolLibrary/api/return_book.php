<?php
require_once "../db.php";

$reader = $_POST["reader"] ?? "";
$book_title = $_POST["book_title"] ?? "";

if (empty($reader) || empty($book_title)) {
    echo "Invalid data12: reader: $reader, book_title: $book_title";
    exit;
}

$sql = "
SELECT b.id AS borrowed_id, bk.id AS book_id
FROM borrowed b
JOIN books bk ON bk.id = b.book_id
WHERE b.reader = ? AND bk.title = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $reader, $book_title);
if (!$stmt->execute()) {
    die("SQL query problem");
}
$stmt->store_result();
if ($stmt->num_rows === 0) {
    echo "Книгата не е заета!";
    exit;
}
$stmt->bind_result($borrowed_id, $book_id);
$stmt->fetch();
$stmt->close();

$sql = "
UPDATE books SET available_copies = available_copies + 1
WHERE id = ?
";

$updateStmt = $conn->prepare($sql);
$updateStmt->bind_param("i", $book_id);
if (!$updateStmt->execute()) {
    die("SQL query problem");
}
$updateStmt->close();

$sql = "
DELETE FROM borrowed
WHERE id = ?
";
$deleteStmt = $conn->prepare($sql);
$deleteStmt->bind_param("i", $borrowed_id);
if (!$deleteStmt->execute()) {
    die("SQL query problem");
}
$deleteStmt->close();

echo "Книгата е върната успешно!";
