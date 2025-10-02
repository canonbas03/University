<?php
if (
    !empty($_POST["name"]) &&
    !empty($_POST["comment"]) &&
    !empty($_POST["rating"])
) {
    $name = htmlspecialchars($_POST["name"]);
    $comment = htmlspecialchars($_POST["comment"]);
    $rating = htmlspecialchars($_POST["rating"]);

    add_comment($name, $comment, $rating);
    show_comments();
} else {
    echo    "Input data not valid!";
}

function add_comment($name, $comment, $rating)
{
    $line = "$name|$comment|$rating" . PHP_EOL;

    file_put_contents("dataFile.txt", $line, FILE_APPEND);
}

function show_comments()
{
    if (file_exists("dataFile.txt")) {
        $lines = file("dataFile.txt");

        echo "<table border='2'>";
        echo "<tr><th>Name</th><th>Comment</th><th>Rating</th></tr>";

        foreach ($lines as $line) {
            $tokens = explode("|", $line);
            if (count($tokens) == 3) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($tokens[0]) . "</td>";
                echo "<td>" . htmlspecialchars($tokens[1]) . "</td>";
                echo "<td>" . htmlspecialchars($tokens[2]) . "</td>";
                echo "</tr>";
            }
        }

        echo "</table>";
    } else {
        echo "No data found.";
    }
}
