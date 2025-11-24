<?php
session_start();
require_once "db.php";

if (!isset($_SESSION["user_id"])) {
  if (isset($_COOKIE["remember"])) {
    $token = $_COOKIE["remember"];
    $stmt = $conn->prepare("SELECT id, username FROM users WHERE remember_token = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
      $_SESSION['username'] = $user["username"];
      $_SESSION['user_id'] = $user["id"];
    } else {
      header("Location: login.php");
      exit;
    }
  } else {
    header("Location: login.php");
    exit;
  }
}
?>
<!DOCTYPE html>
<html lang="bg">

<head>
  <meta charset="UTF-8">
  <title>Галерия</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="assets/js/main.js"></script>
</head>

<body>

  <!-- Navbar -->
  <div class="navbar">
    <div class="left">
      <span>Здравей, <b id="username"><?= $_SESSION['username'] ?></b></span>
    </div>
    <div class="right">
      <button id="logoutBtn" class="btn">Изход</button>
    </div>
  </div>

  <!-- Основен контейнер -->
  <div class="container">

    <!-- Форма за качване на снимка -->
    <div class="upload-box">
      <h3>Качи нова снимка</h3>
      <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="photo">
        <input type="text" name="description" placeholder="Описание...">
        <button type="submit">Качи</button>
      </form>
    </div>

    <!-- Галерия -->
    <div id="gallery" class="gallery-container"></div>

  </div>

</body>

</html>