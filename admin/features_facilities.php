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

    <script>
        let feature_s_form = document.getElementById('feature_s_form');
        let facility_s_form = document.getElementById('facility_s_form');

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

        function add_facility() {
            let facility_name = facility_s_form.elements['facility_name']?.value;
            let facility_icon = facility_s_form['facility_icon']?.files[0];
            let facility_description = facility_s_form['facility_description']?.value;

            // Validate name and picture presence
            if (facility_name.trim() === '' || facility_description.trim() === '' || !facility_icon) {
                showToast('danger', 'All fields are required!');
                return;
            }

            // Validate file type
            const allowedTypes = ['image/svg+xml'];
            if (!allowedTypes.includes(facility_icon.type)) {
                showToast('danger', 'Invalid image type. Allowed types: SVG.');
                return;
            }

            // Validate file size (limit: 1MB)
            const maxSizeMB = 1;
            if (facility_icon.size / (1024 * 1024) > maxSizeMB) {
                showToast('danger', 'Image size must be less than 1MB.');
                return;
            }

            let formData = new FormData();
            formData.append('facility_name', facility_name);
            formData.append('facility_icon', facility_icon);
            formData.append('facility_description', facility_description);
            formData.append('add_facility', '');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities_crud.php", true);

            xhr.onload = function () {
                var myModal = document.getElementById("facility-s");
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                let response = this.responseText.trim();

                if (response === '1') {
                    showToast('success', "Facility Added!");
                    facility_s_form.reset();
                    get_facilities();
                } else if (response === 'inv_img') {
                    showToast('danger', "Invalid image format!");
                } else if (response === 'inv_size') {
                    showToast('danger', "Image size should be less than 2MB!");
                } else if (response === 'upd_failed') {
                    showToast('danger', "Image upload failed. Please try again!");
                } else {
                    showToast('danger', "Server Down!");
                }
            };

            xhr.send(formData);
        }

        function get_facilities() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                document.getElementById('facilities-data').innerHTML = this.responseText;
            }

            xhr.send('get_facilities');
        }

        function delete_facility(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/features_facilities_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (this.responseText === '1') {
                    showToast('success', "Facility Removed!");
                    get_facilities();
                } else if (this.responseText === 'room_added') {
                    showToast('danger', "Facility is added in room!");
                } else {
                    showToast('danger', "Server Down!");
                }
            }

            xhr.send('delete_facility=' + val);
        }

        window.onload = function () {
            get_features();
            get_facilities();
        }
    </script>
</body>

</html>