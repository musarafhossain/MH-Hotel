<?php
    require_once 'admin/db/db_config.php';
    require_once 'admin/include/essentials.php';

    if(isset($_GET['email_confirmation'])){
        $data = filteration($_GET);
        $email = $data['email'];
        $token = $data['token'];

        // check if the email and token are set
        if(!isset($email) || !isset($token)){
            echo "Invalid link.";
            exit;
        }

        // Check if the token is valid and not expired
        $query = "SELECT * FROM `user_cred` WHERE `email` = ? AND `token` = ? LIMIT 1";
        $values = [$email, $token];
        $result = select($query, $values, 'ss');

        if(mysqli_num_rows($result) == 1){
            $user = mysqli_fetch_assoc($result);
            if($user['is_verified'] == 1){
                echo "Email already verified! You can now log in.";
                redirect('index.php');
                exit;
            }

            // Update the user's email verification status and remove the token
            if($user['token'] != $token){
                echo "Invalid link. Please check your email for the correct link.";
                exit;
            }
            /* if($user['t_expire'] < date('Y-m-d H:i:s')){
                echo "Token expired. Please request a new verification email.";
                exit;
            } */
            $update_query = "UPDATE `user_cred` SET `is_verified` = 1, `token` = NULL, `t_expire` = NULL WHERE `id` = ?";
            $update_values = [$user['id']];
            if(update($update_query, $update_values, 'i')){
                echo "Email verified successfully! You can now log in.";
            } else {
                echo "Error verifying email. Please try again later.";
            }
            //redirect('index.php');
        } else {
            echo "Invalid link. Please check your email for the correct link.";
            //redirect('index.php');
        }
    } else {
        echo "Invalid request.";
    }

?>