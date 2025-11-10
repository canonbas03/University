<?php
require_once "db.php";
$result = $conn->query("SELECT * FROM tasks");

while ($row = $result->fetch_assoc()) {
    $priorityText = ["Нисък", "Среден", "Висок"];
    $priorityColor = ["green", "orange", "red"];
    $statusText = $row["status"] ? "Завършена" : "Незавършена";

    echo "
    <tr>
        <td>{$row["title"]}</td>
        <td style='color: {$priorityColor[$row["priority"]]}'>{$priorityText[$row["priority"]]}</td>
        <td>{$row["deadline"]}</td>
        <td>{$statusText}</td>
        <td>
            <button class='delete' data-id='{$row["id"]}'>Изтрий</button>";

    if (!$row["status"]) {
        echo " <button class='done' data-id='{$row["id"]}'>Отбележи</button>";
    }

    echo " <button class='update' data-id='{$row["id"]}' 
                data-title='{$row["title"]}' 
                data-priority='{$row["priority"]}' 
                data-deadline='{$row["deadline"]}'>
                Промени
           </button>";

    echo "
        </td>
    </tr>
    ";
}
