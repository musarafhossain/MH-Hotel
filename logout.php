<?php
    require_once('admin/include/essentials.php');

    session_start();
    session_destroy();
    redirect('index.php');
?>