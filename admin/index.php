<?php 
    require_once('./db/db_config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Panel</title>
    <!-- Common Links -->
    <?php require_once('./include/links.php'); ?>

    <style>
        .login-form{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 450px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="login-form rounded bg-white shadow overflow-hidden">
        <form action="">
            <h4 class="text-center bg-dark text-white py-3">ADMIN LOGIN PANEL</h4>
            <div class="p-4">
                <div class="mb-3">
                    <label for="login-name" class="form-label">Username</label>
                    <input type="text" name="admin_name" class="form-control shadow-none" id="login-name" autoComplete="username">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="admin_pass" class="form-control shadow-none" id="password"
                        autoComplete="current-password">
                </div>
                <button type="submit" name="admin_login" class="btn text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
    </div>

    <!--Include Common Scripts-->
    <?php require_once('./include/scripts.php'); ?>
</body>

</html>