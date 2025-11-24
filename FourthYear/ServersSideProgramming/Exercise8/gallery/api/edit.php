<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$userId = $_SESSION['user_id'];
$photoId = isset($_POST['photo_id']) ? (int)$_POST['photo_id'] : 0;
$description = isset($_POST['description']) ? trim($_POST['description']) : '';

if ($photoId <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid photo ID']);
    exit;
}

// Check owner
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
    echo json_encode(['success' => false, 'message' => 'You can only edit your own photos']);
    exit;
}

// Update description
$upd = $conn->prepare("UPDATE photos SET description=? WHERE id=?");
$upd->bind_param("si", $description, $photoId);
if ($upd->execute()) {
    $upd->close();
    echo json_encode(['success' => true, 'description' => $description]);
} else {
    $upd->close();
    echo json_encode(['success' => false, 'message' => 'Failed to update description']);
}
