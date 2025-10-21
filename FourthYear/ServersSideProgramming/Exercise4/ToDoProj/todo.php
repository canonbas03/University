<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
$dataFile = "data/{$user}.txt";
$error = '';
$success = '';

// Ensure data folder exists
if (!is_dir('data')) {
    mkdir('data', 0777, true);
}

// Handle new task submission
if (isset($_POST['add_task'])) {
    $task = trim($_POST['task'] ?? '');
    $comment = trim($_POST['comment'] ?? '');
    $date = date("Y-m-d H:i:s");
    $fileName = '';

    // File upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $allowed = ['jpg', 'jpeg', 'png', 'txt'];
        $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            $fileName = uniqid() . "_" . basename($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'], "data/$fileName");
        } else {
            $error = "Невалиден файлов формат!";
        }
    }

    if ($task === '' || $comment === '') {
        $error = "Попълнете всички полета!";
    }

    if (!$error) {
        $line = "$task|$comment|$date|$fileName\n";
        file_put_contents($dataFile, $line, FILE_APPEND);
        $success = "Бележката е добавена!";
    }
}

// Load existing tasks
$tasks = [];
if (file_exists($dataFile)) {
    $lines = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $tasks[] = explode('|', $line);
    }
}
?>
<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Личен дневник / ToDo</title>
</head>
<body>
<h1>Добре дошъл, <?php echo htmlspecialchars($user); ?>!</h1>
<p><a href="logout.php">Изход</a></p>

<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
<?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>

<h2>Добави нова бележка</h2>
<form method="post" enctype="multipart/form-data">
    <p>Задача: <input type="text" name="task"></p>
    <p>Коментар: <textarea name="comment" rows="3" cols="40"></textarea></p>
    <p>Файл (по избор): <input type="file" name="file"></p>
    <p><button name="add_task">Добави</button></p>
</form>

<h2>Моите бележки</h2>
<?php if ($tasks): ?>
    <table border="1" cellpadding="5">
        <tr>
            <th>Задача</th>
            <th>Коментар</th>
            <th>Дата</th>
            <th>Файл</th>
        </tr>
        <?php foreach ($tasks as $t): 
            list($task, $comment, $date, $fileName) = $t;
        ?>
        <tr>
            <td><?php echo htmlspecialchars($task); ?></td>
            <td><?php echo htmlspecialchars($comment); ?></td>
            <td><?php echo htmlspecialchars($date); ?></td>
            <td>
                <?php if ($fileName): ?>
                    <a href="data/<?php echo htmlspecialchars($fileName); ?>" target="_blank">Виж файла</a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Все още нямате добавени бележки.</p>
<?php endif; ?>
</body>
</html>
