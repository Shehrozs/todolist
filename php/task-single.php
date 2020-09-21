<?php
    include('database.php');
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "SELECT * FROM tasks WHERE id_task= $id";
        $result = mysqli_query($connect, $query);  
        if (!$result) {
            die('epic fail'.mysqli_error($connect));
        }  
    }
    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'id' => $row['id_task'],
            'name' => $row['task_name'],
            'date' => $row['task_date']
        );
    }
    $jsonString = json_encode($json[0]);
    echo $jsonString;
?>