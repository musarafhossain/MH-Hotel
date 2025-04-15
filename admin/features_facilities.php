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
</head>

<body class="bg-white">
    <!--Include Header-->
    <?php require_once('./include/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-3">FEATURES & FACILITIES</h3>
                <!-- Table Section -->
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
                                <thead class="sticky-top">
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

    <!--Include Common Scripts-->
    <?php require_once('./include/scripts.php'); ?>

    <script>
        let feature_s_form = document.getElementById('feature_s_form');

        function add_feature() {

            // Validate name and picture presence
            if (feature_s_form.elements['feature_name'].value.trim() === '') {
                showToast('danger', 'All fields are required!');
                return;
            }

            let formData = new FormData();
            formData.append('feature_name', feature_s_form.elements['feature_name'].value);
            formData.append('add_feature', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities_crud.php", true);

            xhr.onload = function () {
                var myModal = document.getElementById("feature-s");
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                let response = this.responseText.trim();

                if (response === '1') {
                    showToast('success', "New Feature Added!");
                    feature_s_form.elements['feature_name'].value = "";
                    get_features();
                } else {
                    showToast('danger', "Server Down!");
                }
            };

            xhr.send(formData);
        }

        function get_features() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('features-data').innerHTML = this.responseText;
            }

            xhr.send('get_features');
        }

        function delete_feature(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (this.responseText === '1') {
                    showToast('success', "Feature Removed!");
                    get_features();
                } else if (this.responseText === 'room_added') {
                    showToast('danger', "Feature is added in room!");
                } else {
                    showToast('danger', "Server Down!");
                }
            }

            xhr.send('delete_feature=' + val);
        }

        window.onload = function () {
            get_features();
        }
    </script>
</body>

</html>