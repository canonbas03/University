<?php
require_once "../db.php";
session_start();

if (empty($_FILES["photo"]["name"])) {
    echo json_encode(["status" => "error", "message" => "Моля, качете файл!"]);
    exit;
}

$dir = "../assets/uploads/";
$allowed = ["jpg", "jpeg", "png", "gif"];
$ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
if (!in_array($ext, $allowed)) {
    echo json_encode(["status" => "error", "message" => "Моля, качете файл с разширение jpg, png или gif!"]);
    exit;
}

if ($_FILES["photo"]["size"] > 5 * 1024 * 1024) {
    echo json_encode(["status" => "error", "message" => "Моля, качете файл до 5MB"]);
    exit;
}

$filename = time() . "_" . $_FILES["photo"]["name"];
$fullPath = $dir . $filename;
if (move_uploaded_file($_FILES["photo"]["tmp_name"], $fullPath)) {
    $desc = $_POST["description"] ?? "";
    $stmt = $conn->prepare("INSERT INTO photos(user_id, filename, description) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $_SESSION["user_id"], $filename, $desc);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Успешно качихте снимка!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Грешка при качване!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Грешка при качване!"]);
}
