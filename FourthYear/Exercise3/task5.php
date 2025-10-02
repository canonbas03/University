<?php
$bonusMessage = isset($_GET["bonus"]) ? "+1 bonus baby!" : "";
if (!empty($_POST["name"]) && !empty($_POST["tech"])) {
    $name = htmlspecialchars($_POST["name"]);
    $tech = htmlspecialchars($_POST['tech']);

    if ($tech == "PHP") {
        echo "Great choice, $name!";
    } else {
        echo "$name. Not bad...maybe.";
    }
} else if ($bonusMessage) {
    echo "You got: $bonusMessage";
} else {
    echo "Input data is invalid!";
}
