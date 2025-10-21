<?php
if(isset($_GET['name']) && isset($_GET['age'])){
    $name = htmlspecialchars($_GET['name']);  // prevents HTML injection
    $age = (int)$_GET['age'];                 // ensures numeric age

    echo "Здравей, $name!<br>";
    echo "Ти си на $age години.";
} else {
    echo "Моля, попълнете всички полета!";
}
?>
