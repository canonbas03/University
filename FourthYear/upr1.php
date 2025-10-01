<?php
$name = "Cani";
$age = 22;

echo "$name is $age years old!";

$a = 8; $b = 6;

echo "<br>\$a=$a and \$b=$b";
echo "<br> \$a+\$b=".($a+$b);
echo "<br> $a+$b=".($a+$b);
echo "<br> \$a%\$b=".($a % $b);

$product = "Laptop";
$price = 1250.5;
$quant = 2;
$totalPrice = $price * $quant;
$dds = $totalPrice * 0.2;

//formatting
$space = str_repeat("&nbsp;",8);

echo "<br>Product: $product";
echo "<br> Unit Price: $price BGN.";
echo "<br> Quantity: $quant";
echo "<br> Total Price (w/o DDS): $totalPrice";

echo "<br><br> Total Price:$space $totalPrice";
echo "<br> DDS(20%):$space $dds";
echo "<br> Grand Total:$space ".($totalPrice + $dds);

echo "<br>Unit Price:$space " . number_format($price, 2) . " BGN";
echo "<br>Total Price (w/o DDS):$space " . number_format($totalPrice, 2);
echo "<br>DDS (20%):$space " . number_format($dds, 2);
echo "<br>Grand Total:$space " . number_format($totalPrice + $dds, 2);

?>
