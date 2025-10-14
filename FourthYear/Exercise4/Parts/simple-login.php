<?php
session_start(); // start a session to track the logged-in user

$error = ''; // to store error messages

if (isset($_POST['login'])) {
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);

    if ($name === '' || $password === '') {
        $error = "Попълнете всички полета!";
    } else {
        // For now, we’ll use a simple test login
        if ($name === 'admin' && $password === '1234') {
            $_SESSION['user'] = $name;
        } else {
            $error = "Грешно име или парола!";
        }
    }
}

?>
<?php if ($error): ?>
    <p style="color:red;"><?php echo $error ?></p>
<?php endif; ?>
<?php if (isset($_SESSION['user'])): ?>
    <p>Здравей, <b><?php echo $_SESSION['user'] ?></b>!</p>
<?php endif; ?>





<!-- HTML/CSS -->
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <title>Отзиви</title>
</head>
<body>

<h1>Отзиви с оценка</h1>

<h3>Вход</h3>
<form method="post">
    <p>Име: <input type="text" name="name"></p>
    <p>Парола: <input type="password" name="password"></p>
    <p><button name="login">Вход</button></p>
</form>


</body>
</html>