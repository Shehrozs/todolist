<?php
    include('database.php');
    $search = $_POST['taskSearch'];
    if (!empty($search)) {
        $query = "SELECT * FROM tasks WHERE task_name LIKE '$search%'";
        $result = mysqli_query($connect, $query);
       if (!$result) {
            die('Query Error'.mysqli_error($connect));
        }
        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['id_task'],
                'name' => $row['task_name'],
                'date' => $row['task_date']
            );
        }
        $jsString = json_encode($json);
        echo($jsString);
    }
    
?>