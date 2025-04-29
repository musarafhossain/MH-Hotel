<?php
    require_once '../admin/db/db_config.php';
    require_once '../admin/include/essentials.php';
    require_once '../include/sendgrid/sendgrid-php.php';
    date_default_timezone_set('Asia/Kolkata');

    function sendMail($email, $token, $type) {
        if($type == 'register'){
            $subject = "Account Verification Link";
            $page = "email_confirm.php";
            $content = "
                Click the link to confirm your email: <br>
                <a href='".SITE_URL."$page?email_confirmation&email=$email&token=$token"."'>
                    CLICK ME
                </a>
            ";
        } else if($type == 'forgot'){
            $subject = "Password Reset Link";
            $page = "reset_password.php";
            $content = "
                Click the link to reset your password: <br>
                <a href='".SITE_URL."$page?reset_password&email=$email&token=$token"."'>
                    CLICK ME
                </a>
            ";
        } else {
            return 0;
        }
        $emailObj = new \SendGrid\Mail\Mail(); 
        $emailObj->setFrom("musaraf.dev@gmail.com", "MH Hotel");
        $emailObj->setSubject($subject);
        $emailObj->addTo($email);
    
        $emailObj->addContent(
            "text/html", 
            $content
        );
    
        $sendgrid = new \SendGrid(SENDGRID_API_KEY);
        try {
            if($sendgrid->send($emailObj)){
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
            return 0;
        }
    }   

    if(isset($_POST['register'])){
        $data = filteration($_POST);

        // match password and confirm password
        if($data['password'] != $data['cpassword']){
            echo json_encode(['status' => 'error', 'message' => 'Password and Confirm Password do not match!']);
            exit;
        }

        // check user exists or not
        $query = "SELECT * FROM `user_cred` WHERE `email` = ? OR `phonenum` = ? LIMIT 1";
        $values = [
            $data['email'], 
            strval($data['phone'])
        ];
        $result = select($query, $values, 'ss');

        if (mysqli_num_rows($result) != 0) {
            $user = mysqli_fetch_assoc($result);
            
            if ($user['email'] == $data['email']) {
                echo json_encode(['status' => 'error', 'message' => 'Email already exists!']);
                exit;
            } elseif ($user['phonenum'] == $data['phone']) {
                echo json_encode(['status' => 'error', 'message' => 'Phone number already exists!']);
                exit;
            }
        }

        // upload user image to server
        $img = uploadUserImage($_FILES['profile']);

        if($img == 'inv_img'){
            echo json_encode(['status' => 'error', 'message' => 'Invalid Image Format!']);
            exit;
        } else if($img == 'upd_failed'){
            echo json_encode(['status' => 'error', 'message' => 'Image Upload Failed!']);
            exit;
        }

        // send confirmation email to user
        $token = bin2hex(random_bytes(16));
        if(!sendMail($data['email'], $token, "register")){
            echo json_encode(['status' => 'error', 'message' => 'Email Sending Failed!']);
            exit;
        }

        // encrypt password
        $enc_pass = password_hash($data['password'], PASSWORD_BCRYPT);

        // insert user data into database
        $query = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `token`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $values = [
            $data['name'], 
            $data['email'], 
            $data['address'], 
            strval($data['phone']),
            $data['pincode'], 
            $data['dob'], 
            $img, 
            $enc_pass, 
            $token
        ];

        $result = insert($query, $values, 'sssssssss');
        if($result){
            echo json_encode(['status' => 'success', 'message' => 'Registration Successful! Please check your email to verify your account.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Registration Failed!']);
        }
    }

    if(isset($_POST['login'])){
        $data = filteration($_POST);

        // check user exists or not
        $query = "SELECT * FROM `user_cred` WHERE (`email` = ? OR `phonenum` = ?) LIMIT 1";
        $values = [
            $data['email'], 
            $data['password']
        ];
        $result = select($query, $values, 'ss');

        if (mysqli_num_rows($result) == 0) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid Credentials!']);
            exit;
        }

        $user = mysqli_fetch_assoc($result);

        // check if user is blocked or not
        if($user['status'] == 0){
            echo json_encode(['status' => 'error', 'message' => 'Your account is blocked!']);
            exit;
        }

        // check if user is verified or not
        if($user['is_verified'] == 0){
            echo json_encode(['status' => 'error', 'message' => 'Your account is not verified!']);
            exit;
        }
        
        // verify password
        if(!password_verify($data['password'], $user['password'])){
            echo json_encode(['status' => 'error', 'message' => 'Invalid Credentials!']);
            exit;
        }

        // set session variables
        session_start();
        $_SESSION['USER_ID'] = $user['id'];
        $_SESSION['USER_NAME'] = $user['name'];
        $_SESSION['USER_EMAIL'] = $user['email'];
        $_SESSION['USER_PHONE'] = $user['phonenum'];
        $_SESSION['USER_PROFILE'] = $user['profile'];
        $_SESSION['login'] = true;

        echo json_encode(['status' => 'success', 'message' => 'Login Successful!']);
    }

    if(isset($_POST['forgot'])){
        $data = filteration($_POST);

        // check user exists or not
        $query = "SELECT * FROM `user_cred` WHERE `email` = ? LIMIT 1";
        $values = [
            $data['email']
        ];
        $result = select($query, $values, 's');

        if (mysqli_num_rows($result) == 0) {
            echo json_encode(['status' => 'error', 'message' => 'Email not found!']);
            exit;
        }

        $user = mysqli_fetch_assoc($result);

        // check user is blocked or not
        if($user['status'] == 0){
            echo json_encode(['status' => 'error', 'message' => 'Your account is blocked!']);
            exit;
        }

        // check if user is verified or not
        if($user['is_verified'] == 0){
            echo json_encode(['status' => 'error', 'message' => 'Your account is not verified!']);
            exit;
        }

        // send confirmation email to user
        $token = bin2hex(random_bytes(16));
        if(!sendMail($data['email'], $token, 'forgot')){
            echo json_encode(['status' => 'error', 'message' => 'Email Sending Failed!']);
            exit;
        }

        // date and time for token expiry
        $date = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $query = "UPDATE `user_cred` SET `token` = ?, `t_expire` = ? WHERE `id` = ?";
        $values = [
            $token, 
            $date, 
            $user['id']
        ];

        $result = update($query, $values, 'ssi');
        if($result){
            echo json_encode(['status' => 'success', 'message' => 'Password Reset Link Sent!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send password reset link!']);
        }
    }

    if(isset($_POST['reset_password'])){
        $data = filteration($_POST);

        // check user exists or not
        $query = "SELECT * FROM `user_cred` WHERE `email` = ? AND `token` = ? LIMIT 1";
        $values = [
            $data['email'], 
            $data['token']
        ];
        $result = select($query, $values, 'ss');

        if (mysqli_num_rows($result) == 0) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid or expired token!']);
            exit;
        }

        $user = mysqli_fetch_assoc($result);

        // check if user is blocked or not
        if($user['status'] == 0){
            echo json_encode(['status' => 'error', 'message' => 'Your account is blocked!']);
            exit;
        }

        // check if user is verified or not
        if($user['is_verified'] == 0){
            echo json_encode(['status' => 'error', 'message' => 'Your account is not verified!']);
            exit;
        }

        // encrypt password
        $enc_pass = password_hash($data['password'], PASSWORD_BCRYPT);

        // update password in database
        $query = "UPDATE `user_cred` SET `password` = ?, `token` = NULL, `t_expire` = NULL WHERE `id` = ?";
        $values = [
            $enc_pass, 
            $user['id']
        ];

        $result = update($query, $values, 'si');
        if($result){
            echo json_encode(['status' => 'success', 'message' => 'Password Reset Successful!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Password Reset Failed!']);
        }
    }
?>