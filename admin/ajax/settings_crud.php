<?php
    require_once('../db/db_config.php');
    require_once('../include/essentials.php');
    adminLogin();

    if (isset($_POST['get_general'])) {
        $query = "SELECT * FROM `settings` WHERE `sl_no` = ?";
        $values = [1];
        $res = select($query, $values, "i");

        if ($res && $row = mysqli_fetch_assoc($res)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'No data found']);
        }
    }
    
    if (isset($_POST['update_general'])) {
        $frm_data = filteration($_POST);
        $query = "UPDATE `settings` SET `site_title`=?,`site_about`=? WHERE `sl_no`=?";
        $values = [$frm_data['site_title'], $frm_data['site_about'], 1];
        $res = update($query, $values, "ssi");

        if ($res) {
            echo $res;
        } else {
            echo json_encode(['error' => 'No data found']);
        }
    }
    
    if (isset($_POST['update_shutdown'])) {
        $frm_data = ($_POST['update_shutdown']==0) ? 1 : 0;
        $query = "UPDATE `settings` SET `shutdown`=? WHERE `sl_no`=?";
        $values = [$frm_data, 1];
        $res = update($query, $values, "ii");

        if ($res) {
            echo $res;
        } else {
            echo json_encode(['error' => 'No data found']);
        }
    }
?>
