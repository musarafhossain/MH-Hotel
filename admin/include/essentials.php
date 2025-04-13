<?php
    function alert($type, $msg){
        echo<<<alert
            <div class="alert alert-$type alert-dismissible fade show custom-alert" role="alert">
                <strong class="me-3">$msg</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        alert;
    }

    function toast($type, $msg) {
        echo <<<TOAST
        <div id="toast-container" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080;">
            <div class="toast align-items-center text-bg-$type border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        $msg
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
        <script>
            const toastEl = document.querySelector('.toast');
            if (toastEl) {
                const bsToast = new bootstrap.Toast(toastEl, { delay: 3000 });
                bsToast.show();
            }
        </script>
        TOAST;
    }

    function redirect($url){
        echo"
            <script>
                window.location.href = '$url';
            </script>
        ";
    }

    function adminLogin(){
        session_start();
        if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)){
            redirect('index.php');
        }
        session_regenerate_id(true);
    }
?>