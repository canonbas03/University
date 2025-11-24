<?php
require_once "../db.php";

$username = $_POST["username"] ?? "";
$email = $_POST["email"] ?? "";
$password  = $_POST["password"] ?? "";
$passwordRepeat = $_POST["password_repeat"] ?? "";

if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
    echo json_encode(['status' => 'error', 'message' => 'Моля, попълнете всички полета!']);
    exit;
}

if ($password != $passwordRepeat) {
    echo json_encode(['status' => 'error', 'message' => 'Двете пароли не съвпадат!']);
    exit;
}

$check_recaptcha = $_POST["recaptcha"];
$secretKey = "6LdffggsAAAAAIIcNGT12BkOJoo1qIHefQfYIAfy";
$verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$check_recaptcha}");
$response = json_decode($verify);
if (!$response->success) {
    echo json_encode(['status' => 'error', 'message' => 'Моля потвърдете, че не сте робот!']);
    exit;
}


$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'Съществува потребител с това потребителско име или с този имейл!']);
    exit;
}

$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $passwordHash);
if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Успешна регистрация!']);
    exit;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Грешка при регистрация!']);
    exit;
}
