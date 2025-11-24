<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="auth-box">
        <h2>Регистрация</h2>
        <input id="regUser" placeholder="Потребител">
        <input id="regEmail" placeholder="Имейл">
        <input id="regPass" type="password" placeholder="Парола">
        <input id="regRepeat" type="password" placeholder="Повтори паролата">
        <div class="g-recaptcha" data-sitekey="6LdffggsAAAAAEaLzv1w5usQSCYx8Q4rHLQGtxf7"></div>
        <button id="regBtn">Регистрация</button>
        <p>Вече имаш профил? <a href="login.php">Вход</a></p>
    </div>
</body>

</html>