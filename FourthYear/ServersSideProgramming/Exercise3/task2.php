<?php
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $userName = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];
    if ($password == "1234") {
        echo "Welcome $userName";
    } else {
        echo "Wrong credentials!";
    }
} else {
    echo "Please fill all the required fields!";
}
