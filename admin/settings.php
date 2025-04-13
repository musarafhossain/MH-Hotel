<?php
    require_once('./include/essentials.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Settings</title>

    <!-- Common Links -->
    <?php require_once('./include/links.php'); ?>
</head>

<body class="bg-white">
    <!--Include Header-->
    <?php require_once('./include/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-3">SETTINGS</h3>

                <!-- General Settings Section -->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Settings</h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-dark shadow-none btn-sm gap-2 d-flex"
                                data-bs-toggle="modal" data-bs-target="#general-s">
                                <i class="bi bi-pencil-square"></i>
                                Edit
                            </button>
                        </div>
                        <div class="border p-4 rounded">
                            <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                            <hr>
                            <p class="card-text" id="site_title"></p>
                        </div>
                        <div class="border p-4 rounded mt-2">
                            <h6 class="card-subtitle mb-1 fw-bold">About us</h6>
                            <hr>
                            <p class="card-text" id="site_about"></p>
                        </div>
                    </div>
                </div>

                <!-- Shutdown Section -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Shutdown Website</h5>
                            <div class="form-check form-switch">
                                <form>
                                    <input onchange="update_shutdown(this.value)" class="form-check-input"
                                        type="checkbox" id="shutdown_toggle">
                                </form>
                            </div>
                        </div>
                        <p class="card-text d-flex align-items-center gap-2" id="site_about">
                            <span class="badge text-bg-danger">Note</span>
                            <span class="text-danger">
                                No customers will be allowed to book hotel room, when shutdown mode is turned on.
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- General Settings Modal -->
        <div class="modal fade" id="general-s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">General Settings</h1>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="site_title_input" class="form-label">Site Title</label>
                                <input type="text" class="form-control shadow-none" id="site_title_input">
                            </div>
                            <div class="mb-3">
                                <label for="site_about_input" class="form-label">About us</label>
                                <textarea class="form-control shadow-none" id="site_about_input" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn text-secondary shadow-none border" data-bs-dismiss="modal"
                                onclick="reset_general_form()">
                                CANCEL
                            </button>
                            <button type="button" class="btn custom-bg text-white shadow-none"
                                onclick="update_general()">
                                SUBMIT
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!--Include Common Scripts-->
        <?php require_once('./include/scripts.php'); ?>

        <script>
            let general_data;

            function get_general() {
                let site_title = document.getElementById('site_title');
                let site_about = document.getElementById('site_about');
                let site_title_input = document.getElementById('site_title_input');
                let site_about_input = document.getElementById('site_about_input');

                let shutdown_toggle = document.getElementById("shutdown_toggle");

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/settings_crud.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function () {
                    general_data = JSON.parse(this.responseText);

                    site_title.innerText = general_data.site_title;
                    site_about.innerText = general_data.site_about;

                    site_title_input.value = general_data.site_title;
                    site_about_input.value = general_data.site_about;

                    if (general_data.shutdown == 0) {
                        shutdown_toggle.checked = false;
                        shutdown_toggle.value = 0;
                    } else {
                        shutdown_toggle.checked = true;
                        shutdown_toggle.value = 1;
                    }
                }

                xhr.send('get_general');
            }

            function update_general() {
                let site_title_value = document.getElementById('site_title_input').value.trim();
                let site_about_value = document.getElementById('site_about_input').value.trim();
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/settings_crud.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function () {
                    var myModal = document.getElementById("general-s");
                    var modal = bootstrap.Modal.getInstance(myModal);
                    modal.hide();

                    if (this.responseText == 1) {
                        showToast('success', "Changes Saved!");
                        get_general();
                    } else {
                        showToast('warning', "No Changes Made!");
                    }
                }

                xhr.send('site_title=' + site_title_value + '&site_about=' + site_about_value + '&update_general');
            }

            function reset_general_form() {
                document.getElementById('site_title_input').value = general_data.site_title;
                document.getElementById('site_about_input').value = general_data.site_about;
            }

            function update_shutdown(value) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/settings_crud.php", true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function () {

                    if (this.responseText == 1 && general_data.shutdown == 0) {
                        showToast('success', "Site has been shutdown!");
                    } else {
                        showToast('success', "Shutdown mode off!");
                    }
                    get_general();
                }

                xhr.send('update_shutdown=' + value);
            }

            window.onload = function () {
                get_general();
            }
        </script>
</body>

</html>