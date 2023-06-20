<?php
    if (isset($_GET['id']) && isset($_GET['list_name'])) {
        $id = $_GET['id'];
        $listName = $_GET['list_name'];
        
        $db = new SQLite3('database.db');
        
        // بررسی وجود رکورد در tbl_tick با شناسه آیتم مورد نظر
        $checkQuery = "SELECT * FROM tbl_tick WHERE id_tbllist = '$id'";
        $checkResult = $db->querySingle($checkQuery);
        
        if (!$checkResult) {
            // حذف رکورد از جدول tbl_list
            $deleteQuery = "DELETE FROM tbl_list WHERE id = '$id'";
            $db->exec($deleteQuery);
        }
        
        $db->close();
    }

    header('Location: index.php?list');
?>
