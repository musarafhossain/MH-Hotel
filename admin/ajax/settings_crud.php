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

    if (isset($_POST['get_contacts'])) {
        $query = "SELECT * FROM `contact_details` WHERE `sl_no` = ?";
        $values = [1];
        $res = select($query, $values, "i");

        if ($res && $row = mysqli_fetch_assoc($res)) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'No data found']);
        }
    }

    if (isset($_POST['update_contacts'])) {
        $frm_data = filteration($_POST);
        $query = "UPDATE `contact_details` SET `address`=?,`gmap`=?,`phone`=?,`email`=?,`facebook`=?,`instagram`=?,`twitter`=?,`linkedin`=?,`youtube`=?,`iframe`=? WHERE `sl_no`=?";
        $values = [$frm_data['address'], $frm_data['gmap'], $frm_data['phone'], $frm_data['email'], $frm_data['facebook'], $frm_data['instagram'], $frm_data['twitter'], $frm_data['linkedin'], $frm_data['youtube'], $frm_data['iframe'], 1];
        $res = update($query, $values, "ssssssssssi");

        if ($res) {
            echo $res;
        } else {
            echo json_encode(['error' => 'No data found']);
        }
    }

    if (isset($_POST['add_member'])){
        $frm_data = filteration($_POST);

        $img_url = uploadImage($_FILES['member_picture'], ABOUT_FOLDER);
        if($img_url=='inv_img' || $img_url=='inv_size' || $img_url=='upd_failed'){
            return $img_url;
        } else {
            $query = "INSERT INTO `team_details`(`name`, `picture`) VALUES (?,?)";
            $values = [$frm_data['member_name'], $img_url];
            $res = insert($query, $values, "ss");

            if ($res) {
                echo $res;
            } else {
                echo json_encode(['error' => 'No data found']);
            }
        }
    }

    if (isset($_POST['get_members'])){
        $res = selectAll('team_details');
        $path = ABOUT_IMG_PATH;

        while ($row = mysqli_fetch_assoc($res)) {
            echo <<<data
                <div class="col-md-2 mb-3">
                    <div class="card bg-dark text-white">
                        <img src="$path$row[picture]" class="card-img" alt="...">
                        <div class="card-img-overlay text-end">
                            <button type="button" onclick="delete_member($row[sl_no])" class="btn btn-danger btn-sm shadow-none">
                                <i class="bi bi-trash me-1"></i>
                                Delete
                            </button>
                        </div>
                        <p class="card-text text-center px-3 py-2">$row[name]</p>
                    </div>
                </div>
            data;
        }
    }

    if (isset($_POST['delete_member'])){
        $frm_data = filteration($_POST);
        $values= [$frm_data['delete_member']];

        $pre_q = "SELECT * FROM `team_details` WHERE `sl_no`=?";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['picture'], ABOUT_FOLDER)){
            $q = "DELETE FROM `team_details` WHERE `sl_no`=?";
            $res = delete($q, $values, "i");
            echo $res;
        } else {
            echo 0;
        }
    }
?>
