<?php
    if (isset($_POST['list_name'])) {
        $listName = $_POST['list_name'];
        
        $db = new SQLite3('database.db');
        $db->exec("INSERT INTO tbl_list (list_name) VALUES ('$listName')");
        $db->close();
    }

    header('Location: index.php');
?>
