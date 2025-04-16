<?php
    require_once('./include/essentials.php');
    require_once('./db/db_config.php');
    adminLogin();

    if (isset($_GET['seen'])) {
        $frm_data = filteration($_GET);
        if($frm_data['seen']=='all'){
            $q = "UPDATE `user_queries` SET `seen`=?";
            $values=[1];
            if(update($q, $values, "i")){
                toast('success', "Marked all as read!");
            } else{
                toast('danger', "Operation Failed!");
            }
        }else{
            $q = "UPDATE `user_queries` SET `seen`=? WHERE `sl_no`=?";
            $values=[1, $frm_data['seen']];
            if(update($q, $values, "ii")){
                toast('success', "Marked as read!");
            } else{
                toast('danger', "Operation Failed!");
            }
        }
        header("Location: {$_SERVER['PHP_SELF']}");
    }
    
    if (isset($_GET['del'])) {
        $frm_data = filteration($_GET);
        if($frm_data['del']=='all'){
            $q = "DELETE FROM `user_queries`";
            if(mysqli_query($conn ,$q)){
                toast('success', "Deleted Succesfully!");
            } else{
                toast('danger', "Operation Failed!");
            }
        }else{
            $q = "DELETE FROM `user_queries` WHERE `sl_no`=?";
            $values=[$frm_data['del']];
            if(delete($q, $values, "i")){
                toast('success', "All Data Deleted Succesfully!");
            } else{
                toast('danger', "Operation Failed!");
            }
        }
        header("Location: {$_SERVER['PHP_SELF']}");
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Rooms</title>

    <!-- Common Links -->
    <?php require_once('./include/links.php'); ?>

    <style>
        .facility-img {
            width: 100px;
            object-fit: cover;
            aspect-ratio: 1;
        }
    </style>
</head>

<body class="bg-white">
    <!--Include Header-->
    <?php require_once('./include/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-3">ROOMS</h3>

                <!-- Feature Section -->
                <div class="card shadow-sm mb-4 p-4 w-100">
                    <div class="text-end mb-4">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal"
                            data-bs-target="#add-room">
                            <i class="bi bi-plus-square me-1"></i>
                            Add
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive-lg" style="height: 450px; overflow-y: auto;">
                            <table class="table table-bordered table-hover border-info text-center">
                                <thead>
                                    <tr class="table-dark">
                                        <th scope="col">SL.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Guests</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="room-data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Room Modal -->
    <div class="modal fade" id="add-room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Room</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="room_name_input" class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control shadow-none" name="room_name"
                                    id="room_name_input" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_area_input" class="form-label fw-bold">Area</label>
                                <input type="number" class="form-control shadow-none" min="1" name="room_area"
                                    id="room_area_input" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_price_input" class="form-label fw-bold">Price</label>
                                <input type="number" class="form-control shadow-none" min="1" name="room_price"
                                    id="room_price_input" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_quantity_input" class="form-label fw-bold">Quantity</label>
                                <input type="number" class="form-control shadow-none" min="1" name="room_quantity"
                                    id="room_quantity_input" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_adult_input" class="form-label fw-bold">Adult (Max.)</label>
                                <input type="number" class="form-control shadow-none" min="1" name="room_adult"
                                    id="room_adult_input" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_children_input" class="form-label fw-bold">Children (Max.)</label>
                                <input type="number" class="form-control shadow-none" min="1" name="room_children"
                                    id="room_children_input" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Features</label>
                                <div class="row">
                                    <?php
                                        $res = selectAll('features');
                                        while($opt = mysqli_fetch_assoc($res)){
                                            $fullName = htmlspecialchars($opt['name'], ENT_QUOTES); // for safety

                                            echo <<<HTML
                                                <div class="col-md-3 mb-1">
                                                    <label title="$fullName" class="d-block text-truncate" style="max-width: 100%;">
                                                        <input type="checkbox" name="features" value="$opt[sl_no]" class="form-check-input shadow-none me-1">
                                                        $fullName
                                                    </label>
                                                </div>
                                            HTML;
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Facilities</label>
                                <div class="row">
                                    <?php
                                        $res = selectAll('facilities');
                                        while($opt = mysqli_fetch_assoc($res)){
                                            echo<<<HTML
                                                <div class="col-md-3 mb-1">
                                                    <label>
                                                        <input type="checkbox" name="facilities" value="$opt[sl_no]" class="form-check-input shadow-none">
                                                        $opt[name]
                                                    </label>
                                                </div>
                                            HTML;
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="room_description_input" class="form-label fw-bold">Description</label>
                                <textarea name="room_description" id="room_description_input" required rows="4"
                                    class="form-control shadow-none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none border" data-bs-dismiss="modal">
                            CANCEL
                        </button>
                        <button type="button" class="btn custom-bg text-white shadow-none" onclick="add_room()">
                            ADD
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Room Modal -->
    <div class="modal fade" id="edit-room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="edit_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Room</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="room_name_input" class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control shadow-none" name="room_name"
                                    id="room_name_input" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_area_input" class="form-label fw-bold">Area</label>
                                <input type="number" class="form-control shadow-none" min="1" name="room_area"
                                    id="room_area_input" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_price_input" class="form-label fw-bold">Price</label>
                                <input type="number" class="form-control shadow-none" min="1" name="room_price"
                                    id="room_price_input" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_quantity_input" class="form-label fw-bold">Quantity</label>
                                <input type="number" class="form-control shadow-none" min="1" name="room_quantity"
                                    id="room_quantity_input" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_adult_input" class="form-label fw-bold">Adult (Max.)</label>
                                <input type="number" class="form-control shadow-none" min="1" name="room_adult"
                                    id="room_adult_input" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="room_children_input" class="form-label fw-bold">Children (Max.)</label>
                                <input type="number" class="form-control shadow-none" min="1" name="room_children"
                                    id="room_children_input" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Features</label>
                                <div class="row">
                                    <?php
                                        $res = selectAll('features');
                                        while($opt = mysqli_fetch_assoc($res)){
                                            echo<<<HTML
                                                <div class="col-md-3 mb-1">
                                                    <label>
                                                        <input type="checkbox" name="features" value="$opt[sl_no]" class="form-check-input shadow-none">
                                                        $opt[name]
                                                    </label>
                                                </div>
                                            HTML;
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Facilities</label>
                                <div class="row">
                                    <?php
                                        $res = selectAll('facilities');
                                        while($opt = mysqli_fetch_assoc($res)){
                                            echo<<<HTML
                                                <div class="col-md-3 mb-1">
                                                    <label>
                                                        <input type="checkbox" name="facilities" value="$opt[sl_no]" class="form-check-input shadow-none">
                                                        $opt[name]
                                                    </label>
                                                </div>
                                            HTML;
                                        }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="room_description_input" class="form-label fw-bold">Description</label>
                                <textarea name="room_description" id="room_description_input" required rows="4"
                                    class="form-control shadow-none"></textarea>
                            </div>
                            <input type="hidden" name="room_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none border" data-bs-dismiss="modal">
                            CANCEL
                        </button>
                        <button type="button" class="btn custom-bg text-white shadow-none" onclick="edit_room()">
                            UPDATE
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Manage room images modal -->
    <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Room Name</h1>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form id="add_image_form">
                            <label for="member_picture_input" class="form-label fw-bold">Add Image</label>
                            <input type="file" accept=".jpg, .png, .jpeg, .webp" class="form-control shadow-none mb-3"
                                name="image" required>
                            <button type="button" class="btn custom-bg text-white shadow-none" onclick="add_image()">
                                ADD
                            </button>
                            <input type="hidden" name="room_id">
                        </form>
                    </div>
                    <div class="table-responsive-lg" style="height: 350px; overflow-y: auto;">
                        <table class="table table-bordered table-hover border-info text-center">
                            <thead>
                                <tr class="table-dark">
                                    <th scope="col" width="60%">Image</th>
                                    <th scope="col">Thumb</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="room-image-data">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Include Common Scripts-->
    <?php require_once('./include/scripts.php'); ?>

    <script src="./scripts/rooms.js"></script>
</body>

</html>