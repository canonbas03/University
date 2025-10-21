<?php
session_start();

$error = '';
$success = '';

define('USERS_FILE', 'users.txt');

if (isset($_POST['register'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = "Попълнете всички полета!";
    } else {
        // Проверка дали потребителят вече съществува
        if (file_exists(USERS_FILE)) {
            $users = file(USERS_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($users as $u) {
                list($existingUser) = explode('|', $u);
                if ($existingUser === $username) {
                    $error = "Потребителят вече съществува!";
                    break;
                }
            }
        }

        if (!$error) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            file_put_contents(USERS_FILE, "$username|$hash\n", FILE_APPEND);
            $success = "Регистрацията е успешна! Можете да влезете.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
</head>
<body>
    <h1>Регистрация</h1>

    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
    <?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>

    <form method="post">
        <p>Потребителско име: <input type="text" name="username"></p>
        <p>Парола: <input type="password" name="password"></p>
        <p><button name="register">Регистрация</button></p>
    </form>

    <p>Вече имате акаунт? <a href="login.php">Вход</a></p>
</body>
</html>
