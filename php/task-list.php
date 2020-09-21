<?php
    include('database.php');
    $query = "SELECT * FROM tasks";
    $result = mysqli_query($connect, $query);
    if (!$result) {
        die('epic fail'.mysqli_error($connect));
    }
    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'id' => $row['id_task'],
            'name' => $row['task_name'],
            'date' => $row['task_date']
        );
    }
    $jsonString = json_encode($json);
    echo $jsonString;
?>