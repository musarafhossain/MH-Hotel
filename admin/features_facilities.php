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
    <title>Admin Panel - Features & Facilities</title>

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
                <h3 class="mb-3">FEATURES & FACILITIES</h3>

                <!-- Feature Section -->
                <div class="card shadow-sm mb-4 p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title m-0">Features</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark shadow-none btn-sm gap-2 d-flex"
                            data-bs-toggle="modal" data-bs-target="#feature-s">
                            <i class="bi bi-plus-square"></i>
                            Add
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive-md" style="height: 350px; overflow-y: auto;">
                            <table class="table table-bordered table-hover border-info">
                                <thead>
                                    <tr class="table-dark">
                                        <th scope="col">SL.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="features-data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Facilities Section -->
                <div class="card shadow-sm mb-4 p-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h5 class="card-title m-0">Facilities</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark shadow-none btn-sm gap-2 d-flex"
                            data-bs-toggle="modal" data-bs-target="#facility-s">
                            <i class="bi bi-plus-square"></i>
                            Add
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive-md" style="height: 500px; overflow-y: auto;">
                            <table class="table table-bordered table-hover border-info">
                                <thead>
                                    <tr class="table-dark">
                                        <th scope="col">SL.</th>
                                        <th scope="col" width="110px">Icon</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" width="40%">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="facilities-data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Feature Modal -->
    <div class="modal fade" id="feature-s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="feature_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Feature</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="feature_name_input" class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control shadow-none" name="feature_name"
                                id="feature_name_input" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none border" data-bs-dismiss="modal">
                            CANCEL
                        </button>
                        <button type="button" class="btn custom-bg text-white shadow-none" onclick="add_feature()">
                            ADD
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Facility Modal -->
    <div class="modal fade" id="facility-s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="facility_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Facility</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="facility_name_input" class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control shadow-none" name="facility_name"
                                id="facility_name_input" required>
                        </div>
                        <div class="mb-3">
                            <label for="facility_icon_input" class="form-label fw-bold">Icon</label>
                            <input type="file" accept=".svg" name="facility_icon" class="form-control shadow-none"
                                id="facility_icon_input">
                        </div>
                        <div class="mb-3">
                            <label for="facility_description_input" class="form-label">Description</label>
                            <textarea class="form-control shadow-none" rows="3" name="facility_description"
                                id="facility_description_input" autocomplete="street-address"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn text-secondary shadow-none border" data-bs-dismiss="modal">
                            CANCEL
                        </button>
                        <button type="button" class="btn custom-bg text-white shadow-none" onclick="add_facility()">
                            ADD
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--Include Common Scripts-->
    <?php require_once('./include/scripts.php'); ?>

    <script src="./scripts/features_facilities.js"></script>
</body>

</html>