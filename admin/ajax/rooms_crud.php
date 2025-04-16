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
        $res = selectAll('rooms');
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
                        <button type="button" onclick="edit_details($row[sl_no])" class="btn btn-secondary btn-sm shadow-none" data-bs-toggle="modal" data-bs-target="#edit-room">
                            <i class="bi bi-pencil-square me-1"></i>
                            Edit
                        </button>
                        <button type="button" onclick="delete_room($row[sl_no])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash me-1"></i>
                            Delete
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

    if (isset($_POST['delete_feature'])){
        $frm_data = filteration($_POST);
        $values= [$frm_data['delete_feature']];
        $q = "DELETE FROM `features` WHERE `sl_no`=?";
        $res = delete($q, $values, "i");
        echo $res;
    }
?>
