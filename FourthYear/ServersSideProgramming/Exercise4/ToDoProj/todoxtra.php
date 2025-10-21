<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
$dataDir = 'data';
if (!is_dir($dataDir)) mkdir($dataDir, 0777, true);
$dataFile = "$dataDir/{$user}.txt";

$error = '';
$success = '';

// ===== Theme handling =====
if (isset($_POST['theme'])) {
    setcookie('theme', $_POST['theme'], time() + 30*24*60*60); // 30 days
    $_COOKIE['theme'] = $_POST['theme']; // immediate effect
}
$theme = $_COOKIE['theme'] ?? 'light';

// ===== Add task =====
if (isset($_POST['add_task'])) {
    $task = trim($_POST['task'] ?? '');
    $comment = trim($_POST['comment'] ?? '');
    $date = date("Y-m-d H:i:s");
    $fileName = '';

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg','jpeg','png','txt','pdf'];
        if (in_array(strtolower($ext), $allowed)) {
            $fileName = uniqid() . "_{$_FILES['file']['name']}";
            move_uploaded_file($_FILES['file']['tmp_name'], "$dataDir/$fileName");
        } else {
            $error = "Невалиден формат на файла!";
        }
    }

    if ($task === '' || $comment === '') {
        $error = "Попълнете всички полета!";
    } elseif (!$error) {
        $line = "$task|$comment|$date|$fileName\n";
        file_put_contents($dataFile, $line, FILE_APPEND);
        $success = "Задачата е добавена!";
    }
}

// ===== Delete task =====
if (isset($_POST['delete_task'])) {
    $index = intval($_POST['delete_task']);
    if (file_exists($dataFile)) {
        $lines = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (isset($lines[$index])) {
            unset($lines[$index]);
            file_put_contents($dataFile, implode("\n",$lines)."\n");
            $success = "Задачата е изтрита!";
        }
    }
}

// ===== Load tasks =====
$tasks = [];
if (file_exists($dataFile)) {
    $lines = file($dataFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $tasks[] = explode('|', $line); // [task, comment, date, file]
    }
}

// ===== Filter by date =====
if (isset($_POST['filter'])) {
    $start = $_POST['start_date'] ?? '';
    $end = $_POST['end_date'] ?? '';
    $tasks = array_filter($tasks, function($t) use ($start, $end) {
        $date = substr($t[2],0,10);
        return (!$start || $date >= $start) && (!$end || $date <= $end);
    });
}

?>
<!DOCTYPE html>
<html lang="bg">
<head>
<meta charset="utf-8">
<title>Личен дневник / ToDo</title>
<style>
body { font-family: Arial; padding:20px; }
body.light { background:#fff; color:#000; }
body.dark { background:#222; color:#eee; }
table { border-collapse: collapse; width:100%; margin-top:10px; }
th, td { border:1px solid #ccc; padding:8px; text-align:left; }
th { background:#2980b9; color:#fff; }
button { padding:5px 10px; margin:2px; }
.error { color:red; font-weight:bold; }
.success { color:green; font-weight:bold; }
</style>
</head>
<body class="<?php echo $theme; ?>">

<h1>Личен дневник / ToDo - <?php echo htmlspecialchars($user); ?></h1>

<p>
<a href="logout.php">[Изход]</a>
</p>

<!-- Theme toggle -->
<form method="post" style="margin-bottom:15px;">
    <button name="theme" value="light">Светъл режим</button>
    <button name="theme" value="dark">Тъмен режим</button>
</form>

<?php if($error): ?><p class="error"><?php echo $error; ?></p><?php endif; ?>
<?php if($success): ?><p class="success"><?php echo $success; ?></p><?php endif; ?>

<!-- Add task form -->
<h3>Добави задача</h3>
<form method="post" enctype="multipart/form-data">
    <p>Задача:<br><input type="text" name="task" required></p>
    <p>Коментар:<br><textarea name="comment" rows="3" required></textarea></p>
    <p>Файл (по избор):<br><input type="file" name="file"></p>
    <p><button name="add_task">Добави</button></p>
</form>

<!-- Filter by date -->
<h3>Филтрирай по дата</h3>
<form method="post">
    <p>От: <input type="date" name="start_date"></p>
    <p>До: <input type="date" name="end_date"></p>
    <button name="filter">Филтрирай</button>
</form>

<!-- Tasks table -->
<h3>Вашите задачи</h3>
<?php if(count($tasks) > 0): ?>
<table>
<tr><th>#</th><th>Задача</th><th>Коментар</th><th>Дата</th><th>Файл</th><th>Действие</th></tr>
<?php foreach($tasks as $i=>$t): ?>
<tr>
    <td><?php echo $i+1; ?></td>
    <td><?php echo htmlspecialchars($t[0]); ?></td>
    <td><?php echo htmlspecialchars($t[1]); ?></td>
    <td><?php echo htmlspecialchars($t[2]); ?></td>
    <td>
        <?php if($t[3]): ?>
            <a href="data/<?php echo htmlspecialchars($t[3]); ?>" target="_blank">Виж</a>
        <?php endif; ?>
    </td>
    <td>
        <form method="post" style="display:inline;">
            <button name="delete_task" value="<?php echo $i; ?>">Изтрий</button>
        </form>
    </td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<p>Няма задачи!</p>
<?php endif; ?>

</body>
</html>
