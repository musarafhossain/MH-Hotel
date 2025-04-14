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

                <!-- Contact details section -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Contact Settings</h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-dark shadow-none btn-sm gap-2 d-flex"
                                data-bs-toggle="modal" data-bs-target="#contact-s">
                                <i class="bi bi-pencil-square"></i>
                                Edit
                            </button>
                        </div>

                        <div class="row g-3">
                            <!-- Left Column -->
                            <div class="col-lg-6">
                                <div class="border p-4 rounded mb-3">
                                    <h6 class="fw-bold mb-2">Address</h6>
                                    <hr>
                                    <address class="mb-0">
                                        <i class="bi bi-geo-alt-fill text-dark me-1"></i>
                                        <span id="address"></span>
                                    </address>
                                </div>
                                <div class="border p-4 rounded mb-3">
                                    <h6 class="fw-bold mb-2">Google Map</h6>
                                    <hr>
                                    <div class="mb-0">
                                        <i class="bi bi-geo-fill text-dark me-1"></i>
                                        <span id="gmap"></span>
                                    </div>
                                </div>
                                <div class="border p-4 rounded mb-3">
                                    <h6 class="fw-bold mb-2">Phone Numbers</h6>
                                    <hr>
                                    <div class="mb-0">
                                        <i class="bi bi-telephone-fill text-dark me-1"></i>
                                        <span id="phone"></span>
                                    </div>
                                </div>
                                <div class="border p-4 rounded">
                                    <h6 class="fw-bold mb-2">E-mail</h6>
                                    <hr>
                                    <div class="mb-0">
                                        <i class="bi bi-envelope-fill text-dark me-1"></i>
                                        <span id="email"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-lg-6">
                                <div class="border p-4 rounded mb-3">
                                    <h6 class="fw-bold mb-2">Social Links</h6>
                                    <hr>
                                    <div class="mb-1">
                                        <i class="bi bi-facebook text-dark me-1"></i>
                                        <span id="facebook"></span>
                                    </div>
                                    <div class="mb-1">
                                        <i class="bi bi-instagram text-dark me-1"></i>
                                        <span id="instagram"></span>
                                    </div>
                                    <div class="mb-1">
                                        <i class="bi bi-twitter text-dark me-1"></i>
                                        <span id="twitter"></span>
                                    </div>
                                    <div class="mb-1">
                                        <i class="bi bi-linkedin text-dark me-1"></i>
                                        <span id="linkedin"></span>
                                    </div>
                                    <div class="mb-1">
                                        <i class="bi bi-youtube text-dark me-1"></i>
                                        <span id="youtube"></span>
                                    </div>
                                </div>
                                <div class="border p-4 rounded">
                                    <h6 class="fw-bold mb-2">Iframe</h6>
                                    <hr>
                                    <iframe class="mb-0 w-100" id="iframe" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Management Team Section -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Management Team Settings</h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-dark shadow-none btn-sm gap-2 d-flex"
                                data-bs-toggle="modal" data-bs-target="#team-s">
                                <i class="bi bi-plus-square"></i>
                                Add
                            </button>
                        </div>
                        <div class="border p-4 rounded">
                            <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                            <hr>
                            <p class="card-text" id="site_title"></p>
                        </div>
                    </div>
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
                            <label for="site_title_input" class="form-label fw-bold">Site Title</label>
                            <input type="text" class="form-control shadow-none" id="site_title_input">
                        </div>
                        <div class="mb-3">
                            <label for="site_about_input" class="form-label fw-bold">About us</label>
                            <textarea class="form-control shadow-none" id="site_about_input" rows="6"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn text-secondary shadow-none border" data-bs-dismiss="modal"
                            onclick="reset_general_form()">
                            CANCEL
                        </button>
                        <button type="button" class="btn custom-bg text-white shadow-none" onclick="update_general()">
                            SUBMIT
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Contact Settings Modal -->
    <div class="modal fade" id="contact-s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Contact Settings</h1>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid p-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address_input" class="form-label fw-bold">Address</label>
                                        <input type="text" class="form-control shadow-none" id="address_input">
                                    </div>
                                    <div class="mb-3">
                                        <label for="gmap_input" class="form-label fw-bold">Google Map Link</label>
                                        <input type="text" class="form-control shadow-none" id="gmap_input">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone_input" class="form-label fw-bold">Phone Number
                                            (+91)</label>
                                        <input type="text" class="form-control shadow-none" id="phone_input">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email_input" class="form-label fw-bold">Email</label>
                                        <input type="email" class="form-control shadow-none" id="email_input">
                                    </div>
                                    <div class="mb-3">
                                        <label for="iframe_input" class="form-label fw-bold">Iframe</label>
                                        <input type="text" class="form-control shadow-none" id="iframe_input">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone_input" class="form-label fw-bold">Social Links</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">
                                                <i class="bi bi-facebook text-dark me-1"></i>
                                            </span>
                                            <input type="text" class="form-control shadow-none" id="facebook_input">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">
                                                <i class="bi bi-instagram text-dark me-1"></i>
                                            </span>
                                            <input type="text" class="form-control shadow-none" id="instagram_input">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">
                                                <i class="bi bi-twitter text-dark me-1"></i>
                                            </span>
                                            <input type="text" class="form-control shadow-none" id="twitter_input">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">
                                                <i class="bi bi-linkedin text-dark me-1"></i>
                                            </span>
                                            <input type="text" class="form-control shadow-none" id="linkedin_input">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">
                                                <i class="bi bi-youtube text-dark me-1"></i>
                                            </span>
                                            <input type="text" class="form-control shadow-none" id="youtube_input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn text-secondary shadow-none border" data-bs-dismiss="modal"
                            onclick="reset_contacts_form()">
                            CANCEL
                        </button>
                        <button type="button" class="btn custom-bg text-white shadow-none" onclick="update_contacts()">
                            SUBMIT
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Team Management Modal -->
    <div class="modal fade" id="team-s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Team Member</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="memeber_name_input" class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control shadow-none" id="memeber_name_input">
                        </div>
                        <div class="mb-3">
                            <label for="site_about_input" class="form-label fw-bold">Member Picture</label>
                            <input type="file" accept=".jpg, .png, .jpeg, .webp" class="form-control shadow-none"
                                id="memeber_picture_input">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn text-secondary shadow-none border" data-bs-dismiss="modal"
                            onclick="reset_general_form()">
                            CANCEL
                        </button>
                        <button type="button" class="btn custom-bg text-white shadow-none" onclick="update_general()">
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
        let general_data, contacts_data;

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

            // Check if any field is empty
            if (site_title_value === '' || site_about_value === '') {
                showToast('danger', 'All fields are required!');
                return;
            }

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

        function get_contacts() {
            let contacts_p_id = ['address', 'gmap', 'phone', 'email', 'facebook', 'instagram', 'twitter', 'linkedin', 'youtube'];
            let iframe = document.getElementById('iframe');

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                contacts_data = JSON.parse(this.responseText);
                contacts_data = Object.values(contacts_data);

                for (let i = 0; i < contacts_p_id.length; i++) {
                    document.getElementById(contacts_p_id[i]).innerText = contacts_data[i + 1];
                }
                iframe.src = contacts_data[10];
                reset_contacts_form();
            }

            xhr.send('get_contacts');
        }

        function update_contacts() {
            const contacts_p_id = ['address', 'gmap', 'phone', 'email', 'facebook', 'instagram', 'twitter', 'linkedin', 'youtube', 'iframe'];
            const contacts_input_id = ['address_input', 'gmap_input', 'phone_input', 'email_input', 'facebook_input', 'instagram_input', 'twitter_input', 'linkedin_input', 'youtube_input', 'iframe_input'];

            const data = new URLSearchParams();

            // Validate each contact input
            for (let i = 0; i < contacts_input_id.length; i++) {
                const inputElement = document.getElementById(contacts_input_id[i]);
                const value = inputElement?.value.trim() || "";

                if (value === "") {
                    showToast('danger', `All fields are required!`);
                    inputElement?.focus();
                    return;
                }

                data.append(contacts_p_id[i], value);
            }

            data.append("update_contacts", "1");

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/settings_crud.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                const myModal = document.getElementById("contact-s");
                const modal = bootstrap.Modal.getInstance(myModal);
                modal?.hide();

                if (this.responseText.trim() === "1") {
                    showToast('success', "Changes Saved!");
                    get_contacts();
                } else {
                    showToast('warning', "No Changes Made!");
                }
            };

            xhr.send(data.toString());
        }

        function reset_contacts_form() {
            let contacts_input_id = ['address_input', 'gmap_input', 'phone_input', 'email_input', 'facebook_input', 'instagram_input', 'twitter_input', 'linkedin_input', 'youtube_input'];
            let iframe_input = document.getElementById('iframe_input');

            for (let i = 0; i < contacts_input_id.length; i++) {
                document.getElementById(contacts_input_id[i]).value = contacts_data[i + 1];
            }
            iframe_input.value = contacts_data[10];
        }

        window.onload = function () {
            get_general();
            get_contacts();
        }
    </script>
</body>

</html>