<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$userId = $_SESSION['user_id'];
$photoId = isset($_POST['photo_id']) ? (int)$_POST['photo_id'] : 0;

if ($photoId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid photo ID']);
    exit;
}

// Check ownership
$stmt = $conn->prepare("SELECT user_id FROM photos WHERE id=?");
$stmt->bind_param("i", $photoId);
$stmt->execute();
$stmt->bind_result($ownerId);
if (!$stmt->fetch()) {
    $stmt->close();
    echo json_encode(['success' => false, 'message' => 'Photo not found']);
    exit;
}
$stmt->close();

if ($ownerId != $userId) {
    echo json_encode(['success' => false, 'message' => 'You can only delete your own photos']);
    exit;
}

// Delete the photo file from server
$stmt = $conn->prepare("SELECT filename FROM photos WHERE id=?");
$stmt->bind_param("i", $photoId);
$stmt->execute();
$stmt->bind_result($filename);
$stmt->fetch();
$stmt->close();

$filePath = "../assets/uploads/" . $filename;
if (file_exists($filePath)) {
    unlink($filePath);
}

// Delete the photo from database (likes will cascade if foreign key ON DELETE CASCADE)
$del = $conn->prepare("DELETE FROM photos WHERE id=?");
$del->bind_param("i", $photoId);
if ($del->execute()) {
    $del->close();
    echo json_encode(['success' => true]);
} else {
    $del->close();
    echo json_encode(['success' => false, 'message' => 'Failed to delete photo']);
}
