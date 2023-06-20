<?php
    if (isset($_GET['id']) && isset($_GET['list_name'])) {
        $id = $_GET['id'];
        $listName = $_GET['list_name'];
        $dateChecked = date('Y-m-d');
        
        $db = new SQLite3('database.db');
        $db->exec("INSERT INTO tbl_tick (id_tbllist, date_checked) VALUES ('$id', '$dateChecked')");
        $db->close();
    }

    header('Location: index.php');
?>
