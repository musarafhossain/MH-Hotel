<?php
    require_once('../db/db_config.php');
    require_once('../include/essentials.php');
    adminLogin();

    if (isset($_POST['get_users'])){
        $res = selectAll('user_cred');
        $i = 1;
        $path = USERS_IMG_PATH;
        if (mysqli_num_rows($res) == 0) {
            echo <<<HTML
                <tr>
                    <td colspan="11" class="text-center text-muted" style="height: 300px; vertical-align: middle;">
                        No users found.
                    </td>
                </tr>                                            
            HTML;
        }

        while ($row = mysqli_fetch_assoc($res)) {
            $verified = $row['is_verified'] ? 
                "<span class='badge bg-success'>
                    <i class='bi bi-check-lg'></i>
                </span>" :
                "<span class='badge bg-danger'>
                    <i class='bi bi-x-lg'></i>
                </span>"; 
            
            $status = $row['status'] ? 
                "<button onclick='toggle_status($row[id], 0)'        class='btn btn-success btn-sm shadow-none'>
                        Active
                </button>" :
                "<button onclick='toggle_status($row[id], 1)' class='btn btn-warning btn-sm shadow-none'>
                        Inactive
                </button>"; 

            $date = date("d-m-Y", strtotime($row['datetime']));
            echo <<<data
                <tr class='align-middle'>
                    <th scope="row">{$i}</th>
                    <td>
                        <img src='$path$row[profile]' width='55px'/>
                    </td>
                    <td>{$row["name"]}</td>
                    <td>{$row["email"]}</td>
                    <td>{$row["phonenum"]}</td>
                    <td>{$row["address"]} | {$row["pincode"]}</td>
                    <td>{$row["dob"]}</td>
                    <td>$verified</td>
                    <td>$status</td>
                    <td>{$date}</td>
                    <td>
                        <button title="Delete" type="button" onclick="delete_user($row[id])" class="btn btn-danger btn-sm shadow-none mb-2">
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

        $q = "UPDATE `user_cred` SET `status`=? WHERE `id`=?";
        
        $res = update($q, $values, "ii");
        if($res==1){
            echo 1;
        } else {
            echo 0;
        }
    }
    
    if (isset($_POST['delete_user'])){
        $frm_data = filteration($_POST);

        $row = select("SELECT * FROM `user_cred` WHERE `id`=?", [$frm_data['user_id']], 'i');
        $row = mysqli_fetch_assoc($row);

        $is_deleted = deleteImage($row['profile'], USERS_FOLDER);
        
        $res = delete("DELETE FROM `user_cred` WHERE `id`=?", [$frm_data['user_id']], 'i');

        if($res && $is_deleted){    
            echo 1;
        } else {
            echo 0;
        }
    }

    if (isset($_POST['search_users'])){
        $frm_data = filteration($_POST);
        $search = $frm_data['name'];

        $query = "SELECT * FROM `user_cred` WHERE `name` LIKE ? OR `email` LIKE ?";
        $values = ["%$search%", "%$search%"];
        $res = select($query, $values, 'ss');
        $i = 1;
        $path = USERS_IMG_PATH;
        if (mysqli_num_rows($res) == 0) {
            echo <<<HTML
                <tr>
                    <td colspan="11" class="text-center text-muted" style="height: 300px; vertical-align: middle;">
                        No users found.
                    </td>
                </tr>                                            
            HTML;
        }

        while ($row = mysqli_fetch_assoc($res)) {
            $verified = $row['is_verified'] ? 
                "<span class='badge bg-success'>
                    <i class='bi bi-check-lg'></i>
                </span>" :
                "<span class='badge bg-danger'>
                    <i class='bi bi-x-lg'></i>
                </span>"; 
            
            $status = $row['status'] ? 
                "<button onclick='toggle_status($row[id], 0)'        class='btn btn-success btn-sm shadow-none'>
                        Active
                </button>" :
                "<button onclick='toggle_status($row[id], 1)' class='btn btn-warning btn-sm shadow-none'>
                        Inactive
                </button>"; 

            $date = date("d-m-Y", strtotime($row['datetime']));
            echo <<<data
                <tr class='align-middle'>
                    <th scope="row">{$i}</th>
                    <td>
                        <img src='$path$row[profile]' width='55px'/>
                    </td>
                    <td>{$row["name"]}</td>
                    <td>{$row["email"]}</td>
                    <td>{$row["phonenum"]}</td>
                    <td>{$row["address"]} | {$row["pincode"]}</td>
                    <td>{$row["dob"]}</td>
                    <td>$verified</td>
                    <td>$status</td>
                    <td>{$date}</td>
                    <td>
                        <button title="Delete" type="button" onclick="delete_user($row[id])" class="btn btn-danger btn-sm shadow-none mb-2">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            data;
            $i++;
        }
    }
?>
