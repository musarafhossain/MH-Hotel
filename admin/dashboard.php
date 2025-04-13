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
    <div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between">
        <h3 class="mb-0">ADMIN PANEL</h3>
        <a href="logout.php" class="btn btn-danger btn-sm">LOGOUT</a>
    </div>

    <!--Include Common Scripts-->
    <?php require_once('./include/scripts.php'); ?>
</body>
</html>