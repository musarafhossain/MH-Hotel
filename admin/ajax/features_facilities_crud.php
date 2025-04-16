<?php
    require_once('../db/db_config.php');
    require_once('../include/essentials.php');
    adminLogin();

    if (isset($_POST['add_feature'])){
        $frm_data = filteration($_POST);

        $q = "INSERT INTO `features`(`name`) VALUES (?)";
        $values = [$frm_data['feature_name']];
        $res = insert($q, $values, "s");
        echo $res;
    }

    if (isset($_POST['get_features'])){
        $res = selectAll('features');
        $i = 1;
        if (mysqli_num_rows($res) == 0) {
            echo <<<HTML
                <tr>
                    <td colspan="7" class="text-center text-muted" style="height: 300px; vertical-align: middle;">
                        No features found.
                    </td>
                </tr>                                            
            HTML;
        }

        while ($row = mysqli_fetch_assoc($res)) {
            echo <<<data
                <tr>
                    <th scope="row">{$i}</th>
                    <td>{$row['name']}</td>
                    <td>
                        <button type="button" onclick="delete_feature($row[sl_no])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash me-1"></i>
                            Delete
                        </button>
                    </td>
                </tr>
            data;
            $i++;
        }
    }

    if (isset($_POST['delete_feature'])){
        $frm_data = filteration($_POST);
        $values= [$frm_data['delete_feature']];

        $check_q = select("SELECT * FROM `room_features` WHERE `features_id`=?", [$frm_data['delete_feature']], 'i');
        if (mysqli_num_rows($check_q)==0){ 
            $q = "DELETE FROM `features` WHERE `sl_no`=?";
            $res = delete($q, $values, "i");
            echo $res;   
        } else {
            echo 'room_added';
        }
    }

    if (isset($_POST['add_facility'])){
        $frm_data = filteration($_POST);

        $img_url = uploadSVGImage($_FILES['facility_icon'], FACILITIES_FOLDER);
        if($img_url=='inv_img' || $img_url=='inv_size' || $img_url=='upd_failed'){
            return $img_url;
        } else {
            $query = "INSERT INTO `facilities`(`icon`, `name`, `description`) VALUES (?,?,?)";
            $values = [$img_url, $frm_data['facility_name'], $frm_data['facility_description']];
            $res = insert($query, $values, "sss");

            if ($res) {
                echo $res;
            } else {
                echo json_encode(['error' => 'No data found']);
            }
        }
    }

    if (isset($_POST['get_facilities'])){
        $res = selectAll('facilities');
        $i = 1;
        if (mysqli_num_rows($res) == 0) {
            echo <<<HTML
                <tr>
                    <td colspan="7" class="text-center text-muted" style="height: 300px; vertical-align: middle;">
                        No facilities found.
                    </td>
                </tr>                                            
            HTML;
        }
        $path = FACILITIES_IMG_PATH;
        while ($row = mysqli_fetch_assoc($res)) {
            echo <<<data
                <tr class="align-middle">
                    <th scope="row">{$i}</th>
                    <td><img src="$path$row[icon]" class="card-img facility-img border" alt="..."></td>
                    <td>{$row['name']}</td>
                    <td>{$row['description']}</td>
                    <td>
                        <button type="button" onclick="delete_facility($row[sl_no])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash me-1"></i>
                            Delete
                        </button>
                    </td>
                </tr>
            data;
            $i++;
        }
    }

    if (isset($_POST['delete_facility'])){
        $frm_data = filteration($_POST);
        $values= [$frm_data['delete_facility']];

        $check_q = select("SELECT * FROM `room_facilities` WHERE `facilities_id`=?", [$frm_data['delete_facility']], 'i');

        if (mysqli_num_rows($check_q)==0){ 
            $pre_q = "SELECT * FROM `facilities` WHERE `sl_no`=?";
            $res = select($pre_q, $values, 'i');
            $img = mysqli_fetch_assoc($res);

            if(deleteImage($img['icon'], FACILITIES_FOLDER)){
                $q = "DELETE FROM `facilities` WHERE `sl_no`=?";
                $res = delete($q, $values, "i");
                echo $res;
            } else {
                echo 0;
            }
        } else {
            echo 'room_added';
        }
        
    }

?>
