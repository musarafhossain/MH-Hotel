<?php
    //Frontend Image path
    define('SITE_URL', 'http://127.0.0.1/mhhotel/');
    define('ABOUT_IMG_PATH', SITE_URL.'images/about/');
    define('CAROUSEL_IMG_PATH', SITE_URL.'images/carousel/');
    define('FACILITIES_IMG_PATH', SITE_URL.'images/facilities/');
    define('ROOMS_IMG_PATH', SITE_URL.'images/rooms/');

    // sendgrid API key
    define('SENDGRID_API_KEY', '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');

    // Backend upload path 
    define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT']."/mhhotel/images/");
    define('ABOUT_FOLDER', "about/");
    define('CAROUSEL_FOLDER', "carousel/");
    define('FACILITIES_FOLDER', "facilities/");
    define('ROOMS_FOLDER', "rooms/");
    define('USERS_FOLDER', "users/");

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

    function uploadImage($image, $folder) {
        $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
        $img_mime = $image['type'];

        if (!in_array($img_mime, $valid_mime)) {
            return 'inv_img';
        } else if (($image['size'] / (1024 * 1024)) > 2) {
            return 'inv_size';
        } else {
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $new_name = "IMG_" . uniqid() . '.' . $ext;
            $img_path = UPLOAD_IMAGE_PATH . $folder . $new_name;

            if (move_uploaded_file($image['tmp_name'], $img_path)) {
                return $new_name;
            } else {
                return 'upd_failed';
            }
        }
    }

    function deleteImage($image, $folder){
        if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
            return true;
        } else {
            return false;
        }
    }

    function adminLogin(){
        session_start();
        if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)){
            redirect('index.php');
        }
        //session_regenerate_id(true);
    }

    function uploadSVGImage($image, $folder) {
        $valid_mime = ['image/svg+xml'];
        $img_mime = $image['type'];

        if (!in_array($img_mime, $valid_mime)) {
            return 'inv_img';
        } else if (($image['size'] / (1024 * 1024)) > 1) {
            return 'inv_size';
        } else {
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $new_name = "IMG_" . uniqid() . '.' . $ext;
            $img_path = UPLOAD_IMAGE_PATH . $folder . $new_name;

            if (move_uploaded_file($image['tmp_name'], $img_path)) {
                return $new_name;
            } else {
                return 'upd_failed';
            }
        }
    }

    function uploadUserImage($image) {
        $valid_mime = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        $img_mime = $image['type'];
    
        // Check if the file is a valid image type
        if (!in_array($img_mime, $valid_mime)) {
            return 'inv_img'; // Invalid image type
        }
    
        // Get the extension and convert it to lowercase
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $ext = strtolower($ext);
    
        // Generate a new unique name for the image
        $new_name = "IMG_" . uniqid() . '.jpeg'; // Always save as .jpeg
        $img_path = UPLOAD_IMAGE_PATH . USERS_FOLDER . $new_name;
    
        // Create image resource based on the original MIME type
        switch ($ext) {
            case 'png':
                $img = imagecreatefrompng($image['tmp_name']);
                break;
            case 'webp':
                $img = imagecreatefromwebp($image['tmp_name']);
                break;
            default:
                $img = imagecreatefromjpeg($image['tmp_name']); // If JPEG, no conversion needed
                break;
        }
    
        // Save the image as JPEG, with 75% quality
        if (imagejpeg($img, $img_path, 75)) {
            return $new_name;
        } else {
            return 'upd_failed'; // Failed to upload
        }
    }
    
?>