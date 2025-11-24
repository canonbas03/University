<?php
session_start();
require_once "../db.php";

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not logged in']);
    exit;
}

$userId = $_SESSION['user_id'];
$photoId = $_POST['photo_id'];

// Check if already liked
$stmt = $conn->prepare("SELECT id FROM likes WHERE user_id=? AND photo_id=?");
$stmt->bind_param("ii", $userId, $photoId);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Unlike
    $del = $conn->prepare("DELETE FROM likes WHERE user_id=? AND photo_id=?");
    $del->bind_param("ii", $userId, $photoId);
    $del->execute();
    $liked = false;
} else {
    // Like
    $ins = $conn->prepare("INSERT INTO likes (user_id, photo_id) VALUES (?, ?)");
    $ins->bind_param("ii", $userId, $photoId);
    $ins->execute();
    $liked = true;
}

// Get updated total likes
$count = $conn->prepare("SELECT COUNT(*) as c FROM likes WHERE photo_id=?");
$count->bind_param("i", $photoId);
$count->execute();
$totalLikes = $count->get_result()->fetch_assoc()['c'];

echo json_encode([
    'success' => true,
    'liked' => $liked,
    'likes' => $totalLikes
]);
