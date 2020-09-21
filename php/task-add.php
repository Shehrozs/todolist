<?php
    include ('database.php');
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $date = $_POST['date'];
        $query = "INSERT INTO tasks (task_name, task_date) VALUES ('$name','$date')";
        $result = mysqli_query($connect, $query);
        if (!$result) {
            die('epic fail'.mysqli_error($connect));
        }
        echo 'add success'; 
    }
?>