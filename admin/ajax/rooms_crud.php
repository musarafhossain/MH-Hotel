<?php
    require_once('../db/db_config.php');
    require_once('../include/essentials.php');
    adminLogin();

    if (isset($_POST['add_room'])){
        $features = filteration(json_decode($_POST['room_features']));
        $facilities = filteration(json_decode($_POST['room_facilities']));
        $frm_data = filteration($_POST);
        
        $q1 = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `adult`, `children`, `description`) VALUES (?,?,?,?,?,?,?)";
        $values = [$frm_data['room_name'], $frm_data['room_area'], $frm_data['room_price'], $frm_data['room_quantity'], $frm_data['room_adult'], $frm_data['room_children'], $frm_data['room_description']];

        $flag = 0;
        if(insert($q1, $values, "siiiiis")){
            $flag = 1;
        }

        $room_id = mysqli_insert_id($conn);

        $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";

        if($stmt = mysqli_prepare($conn, $q2)){
            foreach($facilities as $f){
                mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            $flag = 0;
            die("Query cannot be executed - Insert");
        }
        
        $q3 = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";

        if($stmt = mysqli_prepare($conn, $q3)){
            foreach($features as $f){
                mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            $flag = 0;
            die("Query cannot be executed - Insert");
        }

        if($flag){
            echo 1;
        } else {
            echo 0;
        }
    }

    if (isset($_POST['get_rooms'])){
        $res = select("SELECT * FROM `rooms` WHERE `removed`=?", [0], 'i');
        $i = 1;
        if (mysqli_num_rows($res) == 0) {
            echo <<<HTML
                <tr>
                    <td colspan="8" class="text-center text-muted" style="height: 300px; vertical-align: middle;">
                        No features found.
                    </td>
                </tr>                                            
            HTML;
        }

        while ($row = mysqli_fetch_assoc($res)) {
            if($row['status']==1){
                $status = "
                    <button onclick='toggle_status($row[sl_no], 0)' class='btn btn-success btn-sm shadow-none'>
                        Active
                    </button>
                ";
            } else {
                $status = "
                    <button onclick='toggle_status($row[sl_no], 1)' class='btn btn-warning btn-sm shadow-none'>
                        Inactive
                    </button>
                ";
            }
            echo <<<data
                <tr class='align-middle'>
                    <th scope="row">{$i}</th>
                    <td>{$row["name"]}</td>
                    <td>{$row["area"]} sq. ft.</td>
                    <td>
                        <span class="badge rounded-pill bg-light text-dark">
                            Adult: $row[adult]
                        </span><br>
                        <span class="badge rounded-pill bg-light text-dark">
                            Children: $row[children]
                        </span>
                    </td>
                    <td>₹{$row["price"]}</td>
                    <td>{$row["quantity"]}</td>
                    <td>$status</td>
                    <td>
                        <button title="Edit" type="button" onclick="edit_details($row[sl_no])" class="btn btn-secondary btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#edit-room">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button title="Add Image" type="button" onclick="room_images({$row['sl_no']}, '{$row['name']}')" class="btn btn-info btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#room-images">
                            <i class="bi bi-images"></i>
                        </button>
                        <button title="Delete" type="button" onclick="delete_room($row[sl_no])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            data;
            $i++;
        }
    }

    if (isset($_POST['toggle_status'])){
        $frm_data = filteration($_POST);
        $values= [$frm_data['value'], $frm_data['toggle_status']];

        $q = "UPDATE `rooms` SET `status`=? WHERE `sl_no`=?";
        
        $res = update($q, $values, "ii");
        if($res==1){
            echo 1;
        } else {
            echo 0;
        }
    }

    if (isset($_POST['get_room'])){
        $frm_data = filteration($_POST);
        
        $res1 = select("SELECT * FROM `rooms` WHERE `sl_no`=?", [$frm_data['get_room']], 'i');
        $res2 = select("SELECT * FROM `room_features` WHERE `room_id`=?", [$frm_data['get_room']], 'i');
        $res3 = select("SELECT * FROM `room_facilities` WHERE `room_id`=?", [$frm_data['get_room']], 'i');

        $roomdata = mysqli_fetch_assoc($res1);
        $features = [];
        $facilities = [];

        if(mysqli_num_rows($res2)>0){
            while ($row = mysqli_fetch_assoc($res2)) {
                array_push($features, $row['features_id']);
            }
        }
        
        if(mysqli_num_rows($res3)>0){
            while ($row = mysqli_fetch_assoc($res3)) {
                array_push($facilities, $row['facilities_id']);
            }
        }

        $data = [
            "roomdata" => $roomdata,
            "features" => $features,
            "facilities" => $facilities
        ];

        $data = json_encode($data);

        echo $data;
    }

    if (isset($_POST['edit_room'])){
        $features = filteration(json_decode($_POST['room_features']));
        $facilities = filteration(json_decode($_POST['room_facilities']));
        $frm_data = filteration($_POST);
        
        $q1 = "UPDATE `rooms` SET `name`=?, `area`=?, `price`=?, `quantity`=?, `adult`=?, `children`=?, `description`=? WHERE `sl_no`=?";

        $values = [$frm_data['room_name'], $frm_data['room_area'], $frm_data['room_price'], $frm_data['room_quantity'], $frm_data['room_adult'], $frm_data['room_children'], $frm_data['room_description'], $frm_data['room_id']];

        $flag = 0;
        if(update($q1, $values, "siiiiisi")){
            $flag = 1;
        }

        $del_features = delete("DELETE FROM `room_features` WHERE `room_id`=?", [$frm_data['room_id']], 'i');    
        $del_facilities = delete("DELETE FROM `room_facilities` WHERE `room_id`=?", [$frm_data['room_id']], 'i');    

        if($del_features == 0 || $del_facilities == 0){
            $flag = 0;
        }

        $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";

        if($stmt = mysqli_prepare($conn, $q2)){
            foreach($facilities as $f){
                mysqli_stmt_bind_param($stmt, 'ii', $frm_data['room_id'], $f);
                mysqli_stmt_execute($stmt);
            }
            $flag = 1;
            mysqli_stmt_close($stmt);
        } else {
            $flag = 0;
            die("Query cannot be executed - Insert");
        }
        
        $q3 = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";

        if($stmt = mysqli_prepare($conn, $q3)){
            foreach($features as $f){
                mysqli_stmt_bind_param($stmt, 'ii', $frm_data['room_id'], $f);
                mysqli_stmt_execute($stmt);
            }
            $flag = 1;
            mysqli_stmt_close($stmt);
        } else {
            $flag = 0;
            die("Query cannot be executed - Insert");
        }

        if($flag){
            echo 1;
        } else {
            echo 0;
        }
    }

    if (isset($_POST['add_image'])){
        $frm_data = filteration($_POST);

        $img_url = uploadImage($_FILES['image'], ROOMS_FOLDER);
        if($img_url=='inv_img' || $img_url=='inv_size' || $img_url=='upd_failed'){
            return $img_url;
        } else {
            $query = "INSERT INTO `room_image`(`room_id`, `image`) VALUES (?,?)";
            $values = [$frm_data['room_id'], $img_url];
            $res = insert($query, $values, "ss");

            if ($res) {
                echo $res;
            } else {
                echo json_encode(['error' => 'No data found']);
            }
        }
    }
    
    if (isset($_POST['get_room_images'])){
        $frm_data = filteration($_POST);
        $res = select("SELECT * FROM `room_image` WHERE `room_id`=?", [$frm_data['get_room_images']], 'i');
        $path = ROOMS_IMG_PATH;

        if (mysqli_num_rows($res) == 0) {
            echo <<<HTML
                <tr>
                    <td colspan="3" class="text-center text-muted" style="height: 300px; vertical-align: middle;">
                        No images found.
                    </td>
                </tr>                                            
            HTML;
        }

        while ($row = mysqli_fetch_assoc($res)) {
            if($row['thumb'] == 1){
                $thumb = "
                    <button type='button' onclick='rem_thumb($row[sl_no], $row[room_id])' class='btn btn-success btn-sm shadow-none'>
                        <i class='bi bi-check-circle'></i>
                    </button>
                ";
            } else {
                $thumb = "
                    <button type='button' onclick='thumb_image($row[sl_no], $row[room_id])' class='btn btn-warning btn-sm shadow-none'>
                        <i class='bi bi-x-circle'></i>
                    </button>
                ";
            }
            echo <<<data
                <tr class="align-middle">
                    <td>
                        <img src="$path$row[image]" class="img-fluid" style="width: 150px; height: 150px; object-fit: cover;">
                    </td>
                    <td class="align-middle">
                        $thumb
                    </td>
                    <td class="align-middle">
                        <button type="button" onclick="delete_image($row[sl_no], $row[room_id])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            data;
        }
    }

    if (isset($_POST['delete_image'])){
        $frm_data = filteration($_POST);
        $values= [$frm_data['image_id'], $frm_data['room_id']];

        $pre_q = "SELECT * FROM `room_image` WHERE `sl_no`=? AND `room_id`=?";
        $res = select($pre_q, $values, 'ii');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['image'], ROOMS_FOLDER)){
            $q = "DELETE FROM `room_image` WHERE `sl_no`=? AND `room_id`=?";
            $res = delete($q, $values, "ii");
            echo $res;
        } else {
            echo 0;
        }
    }

    if(isset($_POST['thumb_image'])){
        $frm_data = filteration($_POST);

        $pre_q = "UPDATE `room_image` SET `thumb`=? WHERE `room_id`=?";
        $pre_v = [0, $frm_data['room_id']];
        $pre_res = update($pre_q, $pre_v, 'ii');

        $q = "UPDATE `room_image` SET `thumb`=? WHERE `sl_no`=? AND `room_id`=?";
        $v= [1, $frm_data['image_id'], $frm_data['room_id']];
        $res = update($q, $v, 'iii');
        
        echo $res;
    }

    if (isset($_POST['rem_thumb'])) {
        $frm_data = filteration($_POST);
    
        $q = "UPDATE `room_image` SET `thumb`=? WHERE `sl_no`=? AND `room_id`=?";
        $v = [0, $frm_data['image_id'], $frm_data['room_id']];
        $res = update($q, $v, 'iii');
    
        echo $res;
    }
    
    if (isset($_POST['delete_room'])){
        $frm_data = filteration($_POST);
        
        $res1 = select("SELECT * FROM `room_image` WHERE `room_id`=?", [$frm_data['room_id']], 'i');

        while ($row = mysqli_fetch_assoc($res1)) {
            deleteImage($row['image'], ROOMS_FOLDER);
        }

        $res2 = delete("DELETE FROM `room_image` WHERE `room_id`=?", [$frm_data['room_id']], 'i');

        $res3 = delete("DELETE FROM `room_features` WHERE `room_id`=?", [$frm_data['room_id']], 'i');
        
        $res4 = delete("DELETE FROM `room_facilities` WHERE `room_id`=?", [$frm_data['room_id']], 'i');

        $res5 = update("UPDATE `rooms` SET `removed`=? WHERE `sl_no`=?", [1, $frm_data['room_id']], 'ii');

        if($res2 || $res3 || $res4 || $res5){
            echo 1;
        } else {
            echo 0;
        }
    }
?>
