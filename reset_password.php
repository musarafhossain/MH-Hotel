<?php require_once('./include/links.php'); ?>
<!--Include Common Scripts-->
<?php require_once('./include/scripts.php'); ?>

<!-- Password reset Modal -->
<div class="modal fade" id="recoveryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="recovery-form" novalidate>
                <div class="modal-header">
                    <h1 class="modal-title fs-5 d-flex align-items-center">
                        <i class="bi bi-shield-lock fs-3 me-2"></i>
                        Set up New Password
                    </h1>
                </div>
                <div class="modal-body">
                    <div class="mb-4">
                        <label for="password" class="form-label">New Password</label>
                        <input 
                            type="password" 
                            class="form-control shadow-none" id="password" 
                            required
                            name="password"
                        >
                    </div>
                    <div class="text-end mb-2">
                        <button type="submit" class="btn btn-dark shadow-none">SUBMIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include_once('admin/db/db_config.php');
    include_once('admin/include/essentials.php');
    
    if(isset($_GET['reset_password'])){
        $email = $_GET['email'];
        $token = $_GET['token'];
        $query = "SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? LIMIT 1";
        $values = [$email, $token];
        $result = select($query, $values, 'ss');
        
        if ($result->num_rows == 0) {
            echo <<<HTML
                <div style="display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column;">
                    <h3 class="text-danger mb-4">Invalid or expired token!</h3>
                    <a href="index.php" class="btn btn-primary">Go Home</a>
                </div>
            HTML;
            exit;
        } else {
            $user = mysqli_fetch_assoc($result);
            if($user['status'] == 0){
                echo <<<HTML
                    <div style="display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column;">
                        <h3 class="text-danger mb-4">Your account is blocked!</h3>
                        <a href="index.php" class="btn btn-primary">Go Home</a>
                    </div>
                HTML;
                exit;
            }
            if($user['is_verified'] == 0){
                echo <<<HTML
                    <div style="display: flex; justify-content: center; align-items: center; height: 100vh; flex-direction: column;">
                        <h3 class="text-danger mb-4">Your account is not verified!</h3>
                        <a href="index.php" class="btn btn-primary">Go Home</a>
                    </div>
                HTML;
                exit;
            }
            echo<<<SHOWMODAL
                <script>
                    const modalElement = document.getElementById('recoveryModal');
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                </script>
            SHOWMODAL;
        }
    }
?>

<script>
    // Get the form
    const recoveryForm = document.getElementById('recovery-form');

    // Parse URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const email = urlParams.get('email');
    const token = urlParams.get('token');

    // Add event listener to the form
    recoveryForm.addEventListener('submit', function (e) {
        e.preventDefault(); // prevent the form from submitting normally

        // Get the form data
        const formData = new FormData(recoveryForm);

        // Append extra data
        formData.append('reset_password', true);
        if (email && token) {
            formData.append('email', email);
            formData.append('token', token);
        }

        // Send the form data using AJAX
        fetch('ajax/login_register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showToast('success', data.message);
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 2000);
            } else {
                showToast('danger', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
</script>
