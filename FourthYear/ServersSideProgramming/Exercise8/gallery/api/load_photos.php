<?php
require_once "../db.php";
session_start();

$userId = $_SESSION['user_id'];

$sql = "SELECT ph.*, u.username,
        (SELECT COUNT(*) FROM likes WHERE photo_id=ph.id) AS totalLikes,
        (SELECT COUNT(*) FROM likes WHERE photo_id=ph.id AND user_id=?) AS userLiked
        FROM photos ph
        JOIN users u ON ph.user_id = u.id
        ORDER BY ph.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

while ($photo = $result->fetch_assoc()) {
    $liked_icon = $photo['userLiked'] ? "❤️" : "🤍";

    echo "<div class='photo-card' data-id='{$photo['id']}'>";
    echo "<img src='assets/uploads/{$photo['filename']}' />";
    echo "<div class='photo-info'>";
    echo "<p class='photo-desc' data-id='{$photo['id']}'><b>{$photo['username']}</b>: {$photo['description']}</p>";
    echo "<p class='small'>Публикувано: {$photo['created_at']}</p>";
    echo "<div class='photo-actions'>";
    echo "<button class='like-btn' data-id='{$photo['id']}'>{$liked_icon} <span class='likes-count'>{$photo['totalLikes']}</span></button>";

    if ($photo['user_id'] == $userId) {
        echo "<button class='edit-btn' data-id='{$photo['id']}'>Редактирай</button>";
        echo "<button class='delete-btn' data-id='{$photo['id']}'>Изтрий</button>";
    }

    echo "</div></div></div>";
}
