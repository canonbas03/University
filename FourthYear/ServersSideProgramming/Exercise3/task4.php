<?php
if (
    !empty($_POST['student']) &&
    !empty($_POST['grade']) &&
    is_numeric($_POST['grade']) &&
    $_POST['grade'] >= 2 && $_POST['grade'] <= 6
) {
    $name = htmlspecialchars($_POST['student']);
    $grade = (int)$_POST['grade'];

    if ($grade >= 5) {
        echo "Congrats, $name, excelent result!";
    } else {
        echo "$name, you have to study harder.";
    }
}
else{
    echo "Invalid data!";
}
