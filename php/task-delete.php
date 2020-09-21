<?php
    include('database.php');
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $query = "DELETE FROM tasks WHERE id_task= $id";
        $result = mysqli_query($connect, $query); 
        if (!$result) {
            die('epic fail'.mysqli_error($connect));
        }
        echo 'delete success';  
    }
?>