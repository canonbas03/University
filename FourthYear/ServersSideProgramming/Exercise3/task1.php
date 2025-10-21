<?php
if (is_numeric($_GET['num1']) && is_numeric($_GET['num2'])) {
    $numOne = (int)$_GET['num1'];
    $numTwo = (int)$_GET['num2'];
    $sum = $numOne + $numTwo;
    echo "The sum is: $sum";
} else {
    echo "Please enter two numbers.";
}