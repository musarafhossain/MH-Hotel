<?php
    require_once('./include/essentials.php');
    require_once('./db/db_config.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Users</title>

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
                <h3 class="mb-3">USERS</h3>

                <!-- Feature Section -->
                <div class="card shadow-sm mb-4 p-4 w-100">
                    <div class="text-end mb-4">
                        <input type="text" id="search" class="form-control w-25 shadow-none ms-auto" placeholder="Search by name or email..." oninput="search_user(this.value)">  
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover border-info text-center" style="min-width: 1300px;">
                                <thead>
                                    <tr class="table-dark">
                                        <th scope="col">SL.</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone no.</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">DOB</th>
                                        <th scope="col">Verified</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="users-data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Include Common Scripts-->
    <?php require_once('./include/scripts.php'); ?>

    <script src="./scripts/users.js"></script>
</body>

</html>