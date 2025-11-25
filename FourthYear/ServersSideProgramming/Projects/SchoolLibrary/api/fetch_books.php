<?php
require_once "../db.php";

$sql = "
SELECT *
FROM books
ORDER BY title
";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    foreach ($result->fetch_all(MYSQLI_ASSOC) as $row) {
        echo "
        <tr>
            <td>{$row['title']}</td>
            <td>{$row['author']}</td>
            <td>{$row['year']}</td>
            <td>{$row['total_copies']}</td>
            <td>{$row['available_copies']}</td>
        </tr>";
    }
}
