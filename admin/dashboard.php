<?php
    require_once('./include/essentials.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>

    <!-- Common Links -->
    <?php require_once('./include/links.php'); ?>
</head>
<body class="bg-white">
    <!--Include Header-->
    <?php require_once('./include/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h1>Dashboard Page</h1>
            </div>
        </div>
    </div>

    <!--Include Common Scripts-->
    <?php require_once('./include/scripts.php'); ?>
</body>
</html>