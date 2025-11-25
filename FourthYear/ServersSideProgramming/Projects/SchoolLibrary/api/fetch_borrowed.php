<?php
require_once "../db.php";

$sql = "
SELECT b.reader, bk.title, b.date_taken
FROM borrowed b
JOIN books bk ON bk.id = b.book_id
ORDER BY b.date_taken DESC
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
        echo "
        <tr>
            <td>{$row['reader']}</td>
            <td>{$row['title']}</td>
            <td>{$row['date_taken']}</td>
        </tr>";
    }
}
