<?php
session_start();

define('USERS_FILE', 'users.txt');      // File for storing users
define('COMMENTS_FILE', 'comments.txt'); // File for storing comments

$error = '';
$success = '';

/* =========================
   HELPER FUNCTIONS
========================= */

// Check if a user already exists
function user_exists($name) {
    if (!file_exists(USERS_FILE)) return false;
    $users = file(USERS_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($users as $u) {
        list($n) = explode('|', $u);
        if ($n === $name) return true;
    }
    return false;
}

// Register a new user
function register_user($name, $password) {
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $line = "$name|$hashed\n";
    file_put_contents(USERS_FILE, $line, FILE_APPEND);
}

// Check login credentials
function check_login($name, $password) {
    if (!file_exists(USERS_FILE)) return false;
    $users = file(USERS_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($users as $u) {
        list($n, $hash) = explode('|', $u);
        if ($n === $name && password_verify($password, $hash)) return true;
    }
    return false;
}

// Add a comment
function add_comment($user, $comment, $rating) {
    $line = "$user|$comment|$rating\n";
    file_put_contents(COMMENTS_FILE, $line, FILE_APPEND);
}

// Display all comments in a table
function show_comments() {
    if (!file_exists(COMMENTS_FILE)) {
        echo "<p>Няма коментари!</p>";
        return;
    }
    $lines = file(COMMENTS_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (empty($lines)) {
        echo "<p>Няма коментари!</p>";
        return;
    }
    echo '<table border="1" cellpadding="5">';
    echo '<tr><th>Потребител</th><th>Коментар</th><th>Оценка</th></tr>';
    foreach ($lines as $line) {
        list($user, $comment, $rating) = explode('|', $line);
        echo '<tr>';
        echo "<td>$user</td>";
        echo "<td>$comment</td>";
        echo "<td>$rating</td>";
        echo '</tr>';
    }
    echo '</table>';
}

/* =========================
   FORM HANDLING
========================= */

// Registration
if (isset($_POST['register'])) {
    $name = trim($_POST['name'] ?? '');
    $pass = trim($_POST['password'] ?? '');
    if ($name === '' || $pass === '') {
        $error = "Попълнете всички полета!";
    } elseif (user_exists($name)) {
        $error = "Потребителят вече съществува!";
    } else {
        register_user($name, $pass);
        $success = "Регистрацията е успешна! Влезте сега.";
    }
}

// Login
if (isset($_POST['login'])) {
    $name = trim($_POST['name'] ?? '');
    $pass = trim($_POST['password'] ?? '');
    if (check_login($name, $pass)) {
        $_SESSION['user'] = $name;
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    } else {
        $error = "Грешно име или парола!";
    }
}

// Add comment
if (isset($_POST['comment_submit']) && isset($_SESSION['user'])) {
    $comment = trim($_POST['comment'] ?? '');
    $rating = trim($_POST['rating'] ?? '');
    if ($comment === '' || $rating === '') {
        $error = "Попълнете всички полета!";
    } else {
        add_comment($_SESSION['user'], $comment, $rating);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <title>Отзиви</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        table, th, td { border: 1px solid #333; }
        th, td { padding: 8px; text-align: left; }
        textarea, select, input { width: 100%; padding: 6px; margin-bottom: 10px; }
        button { padding: 6px 12px; }
        .error { color: red; }
        .success { color: green; }
    </style>
</head>
<body>

<h1>Отзиви с оценка</h1>

<?php if ($error): ?><p class="error"><?php echo $error ?></p><?php endif; ?>
<?php if ($success): ?><p class="success"><?php echo $success ?></p><?php endif; ?>

<?php if (!isset($_SESSION['user'])): ?>
    <h3>Вход / Регистрация</h3>
    <form method="post">
        <p>Име: <input type="text" name="name"></p>
        <p>Парола: <input type="password" name="password"></p>
        <p>
            <button name="login">Вход</button>
            <button name="register">Регистрация</button>
        </p>
    </form>

<?php else: ?>
    <p>Здравей, <b><?php echo $_SESSION['user'] ?></b>! <a href="?logout=1">[Изход]</a></p>

    <h3>Добави коментар</h3>
    <form method="post">
        <p><textarea name="comment" rows="3" placeholder="Вашият коментар"></textarea></p>
        <p>
            Оценка:
            <select name="rating">
                <option value="" selected disabled>--избери--</option>
                <?php for ($i=1; $i<=5; $i++) echo "<option>$i</option>"; ?>
            </select>
        </p>
        <p><button name="comment_submit">Изпрати</button></p>
    </form>

    <h3>Всички коментари:</h3>
    <?php show_comments(); ?>
<?php endif; ?>

</body>
</html>
