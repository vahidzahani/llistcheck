<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لیست</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

    <?php
    if(isset($_REQUEST['list'])){
        fn_list();
    }else{
        fn_index();
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>

<?php
function fn_list(){
    ?>
    <form action="insert.php" method="POST">
        <input type="text" name="list_name" placeholder="نام لیست">
        <input type="submit" value="ذخیره">
    </form>
    <a href="index.php" class="btn btn-primary">لیست امروز</a>
    
    <table border="1" class="table table-bordered">
    <tr>
        <th class="table-primary">نام لیست</th>
        <th class="table-primary">عملیات</th>
    </tr>
    <?php
        $db = new SQLite3('database.db');
        $result = $db->query('SELECT * FROM tbl_list');
        while ($row = $result->fetchArray()) {
            $id = $row['id'];
            $listName = $row['list_name'];

            // بررسی وجود رکورد در tbl_tick با شناسه آیتم مورد نظر
            $checkQuery = "SELECT * FROM tbl_tick WHERE id_tbllist = '$id'";
            $checkResult = $db->querySingle($checkQuery);

            echo '<tr>';
            echo '<td>'.$listName.'</td>';
            echo '<td>';
            
            if (!$checkResult) {
                echo '<a href="delete.php?id='.$id.'&list_name='.$listName.'">DELETE</i>
                </a>';
            } else {
                echo 'حذف نمیشه چون استفاده شده';
            }

            echo '</td>';
            echo '</tr>';
        }
        $db->close();
    ?>
</table>


    <?php
}
function fn_index() {
    ?>
    <a href="?list" class="btn btn-danger" >ویرایش لیست من</a>
    <hr>
    <?php echo date('Y-m-d');?>
    <table border="1" class="table table-bordered">
        <tr>
            <th class="table-primary">نام لیست</th>
            <th class="table-primary">عملیات</th>
        </tr>
        <?php
            $db = new SQLite3('database.db');
            $result = $db->query('SELECT * FROM tbl_list');
            while ($row = $result->fetchArray()) {
                $id = $row['id'];
                $listName = $row['list_name'];

                // بررسی وجود رکورد در tbl_tick با تاریخ امروز و شناسه آیتم مورد نظر
                $checkQuery = "SELECT * FROM tbl_tick WHERE id_tbllist = '$id' AND date_checked = date('now')";
                $checkResult = $db->querySingle($checkQuery);

                // if (!$checkResult) {
                    
                    echo '<tr ';
                    echo ($checkResult)?'class="table-success" ':'';
                    echo '>';
                    
                    echo '<td>'.$listName.'</td>';
                    echo '<td><a href="insert_tick.php?id='.$id.'&list_name='.$listName.'">';
                    echo (!$checkResult)?'DONE':'';
                    echo '</a></td>';
                    echo '</tr>';
                // }
            }
            $db->close();
        ?>
    </table> 
    <?php
}
?>