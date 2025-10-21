<?php
session_start();
$error = '';

define('USERS_FILE', 'users.txt');

if (isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === '') {
        $error = "Попълнете всички полета!";
    } else {
        // Четене на всички потребители
        $found = false;
        if (file_exists(USERS_FILE)) {
            $users = file(USERS_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($users as $u) {
                list($storedUser, $storedHash) = explode('|', $u);
                if ($storedUser === $username && password_verify($password, $storedHash)) {
                    $found = true;
                    break;
                }
            }
        }

        if ($found) {
            // Успешен login
            session_regenerate_id(true);
            $_SESSION['user'] = $username;

            // Optional: remember me with cookie
            if (isset($_POST['remember'])) {
                setcookie('remember_user', $username, time() + 3600 * 24 * 30); // 30 days
            }

            header("Location: todo.php"); // пренасочваме към личния дневник
            exit;
        } else {
            $error = "Грешно име или парола!";
        }
    }
}

// Ако вече има сесия или cookie, можем автоматично да логнем
if (!isset($_SESSION['user']) && isset($_COOKIE['remember_user'])) {
    $_SESSION['user'] = $_COOKIE['remember_user'];
    header("Location: todo.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Вход</title>
</head>
<body>
    <h1>Вход</h1>

    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="post">
        <p>Потребителско име: <input type="text" name="username"></p>
        <p>Парола: <input type="password" name="password"></p>
        <p><input type="checkbox" name="remember"> Запомни ме</p>
        <p><button name="login">Вход</button></p>
    </form>

    <p>Нямате акаунт? <a href="register.php">Регистрация</a></p>
</body>
</html>
