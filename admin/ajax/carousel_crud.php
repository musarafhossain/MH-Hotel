<?php
    require_once('../db/db_config.php');
    require_once('../include/essentials.php');
    adminLogin();

    if (isset($_POST['add_image'])){
        $frm_data = filteration($_POST);

        $img_url = uploadImage($_FILES['picture'], CAROUSEL_FOLDER);
        if($img_url=='inv_img' || $img_url=='inv_size' || $img_url=='upd_failed'){
            return $img_url;
        } else {
            $query = "INSERT INTO `carousel`(`image`) VALUES (?)";
            $values = [$img_url];
            $res = insert($query, $values, "s");

            if ($res) {
                echo $res;
            } else {
                echo json_encode(['error' => 'No data found']);
            }
        }
    }

    if (isset($_POST['get_carousel'])){
        $res = selectAll('carousel');
        $path = CAROUSEL_IMG_PATH;

        while ($row = mysqli_fetch_assoc($res)) {
            echo <<<data
                <style>
                    .team-img {
                        height: 250px;        
                        object-fit: cover;    
                        width: 100%;         
                    }
                </style>
                <div class="col-md-4 mb-3">
                    <div class="card bg-dark text-white">
                        <img src="$path$row[image]" class="card-img team-img w-100" alt="...">
                        <div class="card-img-overlay text-end">
                            <button type="button" onclick="delete_image($row[sl_no])" class="btn btn-danger btn-sm shadow-none">
                                <i class="bi bi-trash me-1"></i>
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            data;
        }
    }

    if (isset($_POST['delete_image'])){
        $frm_data = filteration($_POST);
        $values= [$frm_data['delete_image']];

        $pre_q = "SELECT * FROM `carousel` WHERE `sl_no`=?";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['image'], CAROUSEL_FOLDER)){
            $q = "DELETE FROM `carousel` WHERE `sl_no`=?";
            $res = delete($q, $values, "i");
            echo $res;
        } else {
            echo 0;
        }
    }
?>
