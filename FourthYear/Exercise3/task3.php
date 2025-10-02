<?php
if(!empty($_GET['year']) && is_numeric($_GET['year']))
{
    $year = (int)$_GET['year'];
    $currentYear = date('Y');
    $age = $currentYear - $year;
    echo "You are $age years old.";
}
else {
    echo "Provide a valid year!";
}