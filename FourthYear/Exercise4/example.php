<?php
// Стартираме сесията – нужна е за логина (помни кой е влязъл)
session_start();


// Дефинираме имената на файловете
define('USERS_FILE', 'users.txt');      // файл за потребителите (име + хеширана парола)
define('COMMENTS_FILE', 'comments.txt'); // файл за коментарите

// Променливи за съобщения към потребителя
$error = '';    // при грешки (напр. грешна парола)
$success = '';  // при успешни действия (напр. успешна регистрация)

/* ========================================================
   ФУНКЦИИ
======================================================== */

/**
 * Регистрация на нов потребител.
 * @param string $name - име на потребителя
 * @param string $password - оригиналната парола (ще я хешираме)
 */
function register_user($name, $password)
{
    // Хеширане на паролата (с bcrypt, вграден в PHP)
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Подготвяме ред за запис във файла: име|хеш
    $line = $name . '|' . $hashed . "\n";

    // Добавяме го към файла
    file_put_contents(USERS_FILE, $line, FILE_APPEND);
}

/**
 * Проверява дали потребителят вече съществува.
 * @param string $name - име на потребителя
 * @return bool
 */
function user_exists($name)
{
    // Ако файлът още не е създаден → няма потребители
    if (!file_exists(USERS_FILE)) return false;

    // Четем редовете от файла (всеки ред = един потребител)
    $users = file(USERS_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Обхождаме всеки ред
    foreach ($users as $u) {
        list($n) = explode('|', $u); // вземаме само името
        if ($n === $name) return true; // намерен съвпадение
    }
    return false;
}

/**
 * Проверява дали името и паролата са правилни при вход (login).
 */
function check_login($name, $password)
{
    if (!file_exists(USERS_FILE)) return false;

    $users = file(USERS_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($users as $u) {
        list($n, $hash) = explode('|', $u); // отделяме име и хеш - explode връща масив с list може директно да зададем за всеки един върнат елемент ключ - асоциативен масив
        // Сравняваме въведената парола с хеша
        if ($n === $name && password_verify($password, $hash)) {
            return true;
        }
    }
    return false;
}

/**
 * Добавя коментар във файла.
 * @param string $user - потребителят, който го е написал
 * @param string $comment - съдържанието на коментара
 * @param string $rating - оценка от 1 до 5
 */
function add_comment($user, $comment, $rating)
{
    // Формат на реда: потребител|коментар|оценкая
    $line = "$user|$comment|$rating\n";

    // Добавяме реда към файла
    file_put_contents(COMMENTS_FILE, $line, FILE_APPEND);
}

/**
 * Показва всички коментари от файла.
 */
function show_comments()
{
    // Ако файлът не съществува → няма коментари
    if (!file_exists(COMMENTS_FILE)) {
        echo "<p>Няма коментари!</p>";
        return;
    }

    // Четем всички редове (всеки ред = един коментар)
    $lines = file(COMMENTS_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (empty($lines)) {
        echo "<p>Няма коментари!</p>";
        return;
    }

    // Правим HTML таблица за преглед
    echo '<table border="1" cellpadding="5">';
    echo '<tr><th>Потребител</th><th>Коментар</th><th>Оценка</th><th>Дата</th></tr>';

    // Обхождаме всеки ред и го разделяме по "|"
    foreach ($lines as $line) {
        list($u, $c, $r, $t) = explode('|', $line);
        echo '<tr>';
        echo '<td>' . $u . '</td>';
        echo '<td>' . $c . '</td>';
        echo '<td>' . $r . '</td>';
        echo '<td>' . $t . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

/* ========================================================
   ОБРАБОТКА НА ФОРМИ (POST заявки)
======================================================== */

// ===== Регистрация =====
if (isset($_POST['register'])) {
    $name = trim($_POST['name'] ?? '');
    $pass = trim($_POST['password'] ?? '');

    // Проверка за празни полета
    if ($name === '' || $pass === '') {
        $error = "Попълнете всички полета!";
    } elseif (user_exists($name)) {
        $error = "Потребителят вече съществува!";
    } else {
        // Добавяме новия потребител
        register_user($name, $pass);
        $success = "Регистрацията е успешна! Влезте сега.";
    }
}

// ===== Вход (login) =====
if (isset($_POST['login'])) {
    $name = trim($_POST['name'] ?? '');
    $pass = trim($_POST['password'] ?? '');

    // Проверяваме дали има съвпадение
    if (check_login($name, $pass)) {
        // Запомняме логнатия потребител в сесията
        $_SESSION['user'] = $name;
        // Презареждаме страницата, за да не се изпрати повторно формата
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $error = "Грешно име или парола!";
    }
}

// ===== Добавяне на коментар (само ако е логнат) =====
if (isset($_POST['comment_submit']) && isset($_SESSION['user'])) {
    $comment = trim($_POST['comment'] ?? '');
    $rating = trim($_POST['rating'] ?? '');

    // Проверяваме за празни полета
    if ($comment === '' || $rating === '') {
        $error = "Попълнете всички полета!";
    } else {
        // Добавяме коментара във файла
        add_comment($_SESSION['user'], $comment, $rating);

        // Презареждаме страницата, за да избегнем повторно изпращане
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// ===== Изход (logout) =====
if (isset($_GET['logout'])) {
    // Изтриваме сесията
    session_destroy();
    // Пренасочваме обратно към началната страница
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

/* ========================================================
   HTML ЧАСТ
======================================================== */
?>
<!DOCTYPE html>
<html lang="bg">

<head>
    <meta charset="utf-8">
    <title>Отзиви</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0 20px;
            color: #333;
        }

        h1,
        h3 {
            color: #2c3e50;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
            background-color: #fff;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #2980b9;
            color: #fff;
        }

        form {
            background-color: #fff;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="password"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        button:hover {
            background-color: #3498db;
        }

        p {
            margin: 5px 0;
        }

        a {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>Отзиви с оценка</h1>

    <!-- Показване на съобщения -->
    <?php if ($error): ?>
        <p style="color:red;"><?php echo $error ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p style="color:green;"><?php echo $success ?></p>
    <?php endif; ?>

    <?php if (!isset($_SESSION['user'])): ?>
        <!-- ===============================
     ФОРМА ЗА ВХОД И РЕГИСТРАЦИЯ
================================ -->
        <h3>Вход</h3>
        <form method="post">
            <p>Име: <input type="text" name="name"></p>
            <p>Парола: <input type="password" name="password"></p>
            <p>
                <button name="login">Вход</button>
                <button name="register">Регистрация</button>
            </p>
        </form>

    <?php else: ?>
        <!-- ===============================
     СТРАНИЦА СЛЕД ВХОД
================================ -->
        <p>Здравей, <b><?php echo $_SESSION['user'] ?></b>!
            <a href="?logout=1">[Изход]</a>
        </p>

        <!-- Форма за добавяне на нов коментар -->
        <h3>Добави коментар</h3>
        <form method="post">
            <p><textarea name="comment" rows="3" cols="40" placeholder="Вашият коментар"></textarea></p>
            <p>
                Оценка:
                <select name="rating">
                    <option value="" selected disabled>--избери--</option>
                    <?php
                    // Автоматично генерираме оценките от 1 до 5
                    for ($i = 1; $i <= 5; $i++) echo "<option>$i</option>";
                    ?>
                </select>
            </p>
            <p><button name="comment_submit">Изпрати</button></p>
        </form>

        <hr>

        <!-- Показваме всички коментари -->
        <h3>Всички коментари:</h3>
        <?php show_comments(); ?>

    <?php endif; ?>

</body>

</html>