<?php

// $numbers = [2,3,2,5,8];
// sort($numbers);
// // Method 1: 

// $result = [];

// foreach($numbers as $num)
// {
//     if(!array_key_exists($num,$result))
//         $result[$num] = 1;
//     else
//         $result[$num]++;
// }
// arsort($result);
// $occurence = reset($result); // resets the pointer to index 0, returns value
// $numberFinal = key($result); 

// $test = $result[$numberFinal];

// echo "Most frequent number: $numberFinal ($occurence times)";

// // Method 2 (less code):

// $result2 = array_count_values($numbers);

// arsort($result2);
// $occurence = reset($result2);
// $numberFinal = key($result2);

// echo "<br>Most frequent number: $numberFinal ($occurence times)";

// $space = str_repeat("&nbsp;", 8);
// $studByClass = [

//     'Ivan' => '10A',
//     'Maria' => '10B',
//     'Peter' => '10A',
//     'Anna' => '10B',
//     'George' => '10C'
// ];

// $classes = [];

// foreach ($studByClass as $student => $class) {
//     $classes[$class][] = $student; // [] = adds to the array
// }

// foreach ($classes as $class => $students) {
//     echo "<br>$class: <br>";
//     echo $space . implode(", ", $students);
// }

$studentGrades = [
    'Ivan' => ['Math' => 5, 'Physics' => 6, 'History' => 4],
    'Maria' => ['Math' => 6, 'Physics' => 5, 'History' => 5],
    'Peter' => ['Math' => 4, 'Physics' => 4, 'History' => 6]
];

$bestGrade = 0;
$bestName = '';
foreach ($studentGrades as $student => $grades) {
    $average = array_sum($grades) / count($grades);
    echo "$student - Average grade: " . number_format($average, 2)."<br>";

   if($bestGrade < $average)
   {
    $bestGrade = $average;
    $bestName = $student;
   }
}
echo "Best student - $bestName with an average: ". number_format($bestGrade,2);
