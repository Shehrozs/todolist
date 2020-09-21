<?php
    include('database.php');
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $date = $_POST['date'];
        $query = "UPDATE tasks SET task_name = '$name', task_date = '$date' WHERE id_task = '$id'";
        $result = mysqli_query($connect, $query);  
        if (!$result) {
            die('epic fail'.mysqli_error($connect));
        }
        echo 'edit success';   
    }
?>