<?php
session_start();
$error = '';

// LOGIN
if (isset($_POST['login'])) {
    $name = trim($_POST['name']);
    $pass = trim($_POST['password']);

    if ($name === '' || $pass === '') {
        $error = "Попълнете всички полета!";
    } else {
        // Simple hardcoded login for testing
        if ($name === 'admin' && $pass === '1234') {
            $_SESSION['user'] = $name;
        } else {
            $error = "Грешно име или парола!";
        }
    }
}

// LOGOUT
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// COMMENT
$comments_file = "comments.txt";

if (isset($_POST['comment_submit']) && isset($_SESSION['user'])) {
    $comment = trim($_POST['comment']);
    $rating = trim($_POST['rating']);

    if ($comment === '' || $rating === '') {
        $error = "Попълнете всички полета!";
    } else {
        $user = $_SESSION['user'];
        $line = "$user|$comment|$rating\n";
        file_put_contents($comments_file, $line, FILE_APPEND);
    }
}

?>


<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="utf-8">
    <title>Отзиви</title>
</head>

<body>

    <h1>Отзиви с оценка</h1>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error ?></p>
    <?php endif; ?>

    <?php if (!isset($_SESSION['user'])): ?>
        <!-- LOGIN FORM -->
        <h3>Вход</h3>
        <form method="post">
            <p>Име: <input type="text" name="name"></p>
            <p>Парола: <input type="password" name="password"></p>
            <p><button name="login">Вход</button></p>
        </form>
    <?php else: ?>
        <!-- AFTER LOGIN -->
        <p>Здравей, <b><?php echo $_SESSION['user'] ?></b>!
            <a href="?logout=1">[Изход]</a>
        </p>

        <h3>Добави коментар</h3>
        <form method="post">
            <p><textarea name="comment" rows="3" cols="40" placeholder="Вашият коментар"></textarea></p>
            <p>
                Оценка:
                <select name="rating">
                    <option value="" selected disabled>--избери--</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </p>
            <p><button name="comment_submit">Изпрати</button></p>
        </form>

    <?php endif; ?>

</body>

</html>