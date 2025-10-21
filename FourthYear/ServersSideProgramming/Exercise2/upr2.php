<?php
$number = -8;

if($number > 0)
echo "The number $number is [+]";
else if($number < 0)
    echo "The number $number is [-]";
else echo  "The number is 0";

$dayNum = 5;

$dayOfWeek;
switch($dayNum)
{
    case 1:
        $dayOfWeek = "Monday";
        break;
    case 2:
        $dayOfWeek = "Tuesday";
        break;
    case 3:
        $dayOfWeek = "Wednesday";
        break;
    case 4:
        $dayOfWeek = "Thursday";
        break;
    case 5:
        $dayOfWeek = "Friday";
        break;
    case 6:
        $dayOfWeek = "Saturday";
        break;
    case 7:
        $dayOfWeek = "Sundaay";
        break;
}
echo"<br>". $dayOfWeek;

$cities = ["Tokio", "Istanbul", "Sofia", "Warsawa"];

while(count($cities) > 0)
    echo("<br>".array_shift($cities));

$students = [
    "Ivan" => 6,
    "Mia"  => 5,
    "Dzhukonda" => 2.49,
    "Papazova" => 1
];

foreach($students as $name => $grade)
{
    if($grade > 5)
        echo "<br>$name has $grade<br>";
}

$fruits = [];
array_push($fruits, "Apple");
array_push($fruits, "Pear");
foreach($fruits as $fruit)
    echo "<br>$fruit";

$fruits = [];
array_push($fruits, "Apple");
array_push($fruits, "Pear");
echo"<br>Count of el.: ". count($fruits);
echo"<br> Result: ".(in_array("Apple",$fruits) ? "Yes" : "No");

$grades = [
    "Math" => 6,
    "English" => 4,
    "Science" => 5
];

arsort($grades);
foreach ($grades as $name =>$grade)
    echo "<br>$name - $grade";

$space = str_repeat("&nbsp;", 8);
$school = [
    "Class1" => ["Momo", "Popo", "Pepe"],
    "Class2" => ["Mamuna", "Kominta", "Maira"]
];
foreach ($school as $class => $arr) {
    echo "<br>Class: $class";
    echo "<br>$space" . implode(", ", $arr);
}

$numbers = [5, 12, 8, 7, 9, 4];
$result = [];
foreach ($numbers as $num)
    if ($num > 5)
        array_push($result, $num);
echo "<br>Result array: " . implode(", ", $result);

$numbers = array_filter($numbers, function ($num) {
    return $num > 5;
});
echo "<br>Second way: ".implode(", ", $numbers);
