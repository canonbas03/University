<?php
session_start();

if (isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit;
}
?>
<html lang="bg">

<head>
    <meta charset="UTF-8">
    <title>Вход в галерията</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <div class="auth-box">
        <h2>Вход</h2>
        <input id="loginUser" placeholder="Потребител или имейл">
        <input id="loginPass" type="password" placeholder="Парола">
        <div class="remember-container">
            <input type="checkbox" id="remember">
            <label for="remember">Запомни ме</label>
        </div>
        <div class="g-recaptcha" data-sitekey="6LdffggsAAAAAEaLzv1w5usQSCYx8Q4rHLQGtxf7"></div>
        <button id="loginBtn">Вход</button>
        <p>Нямаш профил? <a href="register.php">Регистрирай се</a></p>
    </div>
</body>

</html>