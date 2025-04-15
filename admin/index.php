<?php 
    require_once('./db/db_config.php');
    require_once('./include/essentials.php');

    session_start();
    if((isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)){
        redirect('dashboard.php');
    }
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
        .login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 450px;
        }

        @media (max-width: 450px) {
            .login-form {
                width: 100%;
            }
        }
    </style>
</head>

<body class="bg-light">
    <div class="login-form rounded bg-white shadow overflow-hidden">
        <form method="post">
            <h4 class="text-center bg-dark text-white py-3">ADMIN LOGIN PANEL</h4>
            <div class="p-4">
                <div class="mb-3">
                    <label for="login-name" class="form-label">Username</label>
                    <input type="text" required name="admin_name" class="form-control shadow-none" id="login-name"
                        autoComplete="username">
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" required name="admin_pass" class="form-control shadow-none" id="password"
                        autoComplete="current-password">
                </div>
                <button type="submit" name="admin_login" class="btn text-white custom-bg shadow-none">LOGIN</button>
            </div>
        </form>
    </div>

    <?php
        if(isset($_POST['admin_login'])){
            $frm_data = filteration($_POST);
            $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_pass`=?";
            $values = [$frm_data['admin_name'], $frm_data['admin_pass']];

            $res = select($query, $values, "ss");

            if($res->num_rows==1){
                $row = mysqli_fetch_assoc($res);
                //session_start();
                $_SESSION['adminLogin'] = true;
                $_SESSION['adminId'] = $row['sl_no'];
                toast('success', 'Login Successful!');
                redirect('dashboard.php');
            } else {
                toast('danger', 'Login Failed - Invalid Credentials!');
            }
        }
    ?>

    <!--Include Common Scripts-->
    <?php require_once('./include/scripts.php'); ?>
</body>

</html>