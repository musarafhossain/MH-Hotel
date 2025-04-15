<?php
    require_once('./include/essentials.php');
    require_once('./db/db_config.php');
    adminLogin();

    if (isset($_GET['seen'])) {
        $frm_data = filteration($_GET);
        if($frm_data['seen']=='all'){
            $q = "UPDATE `user_queries` SET `seen`=?";
            $values=[1];
            if(update($q, $values, "i")){
                toast('success', "Marked all as read!");
            } else{
                toast('danger', "Operation Failed!");
            }
        }else{
            $q = "UPDATE `user_queries` SET `seen`=? WHERE `sl_no`=?";
            $values=[1, $frm_data['seen']];
            if(update($q, $values, "ii")){
                toast('success', "Marked as read!");
            } else{
                toast('danger', "Operation Failed!");
            }
        }
        header("Location: {$_SERVER['PHP_SELF']}");
    }
    
    if (isset($_GET['del'])) {
        $frm_data = filteration($_GET);
        if($frm_data['del']=='all'){
            $q = "DELETE FROM `user_queries`";
            if(mysqli_query($conn ,$q)){
                toast('success', "Deleted Succesfully!");
            } else{
                toast('danger', "Operation Failed!");
            }
        }else{
            $q = "DELETE FROM `user_queries` WHERE `sl_no`=?";
            $values=[$frm_data['del']];
            if(delete($q, $values, "i")){
                toast('success', "All Data Deleted Succesfully!");
            } else{
                toast('danger', "Operation Failed!");
            }
        }
        header("Location: {$_SERVER['PHP_SELF']}");
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - User Queries</title>

    <!-- Common Links -->
    <?php require_once('./include/links.php'); ?>
</head>

<body class="bg-white">
    <!--Include Header-->
    <?php require_once('./include/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-3">USER QUERIES</h3>
                <!-- Table Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">
                            <a href='?seen=all' class='btn btn-warning'>
                                <i class="bi bi-check-all me-1"></i>
                                Mark all as Read
                            </a>
                            <a href="?del=all" class="btn btn-danger">
                                <i class="bi bi-trash me-1"></i>
                                Delete all
                            </a>
                        </div>
                        <div class="table-responsive-md" style="height: 450px; overflow-y: auto;">
                            <table class="table table-bordered table-hover border-info">
                                <thead class="sticky-top">
                                    <tr class="table-dark">
                                        <th scope="col">SL.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Message</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $q = "SELECT * FROM `user_queries` ORDER BY `sl_no` DESC";
                                        $userQueries = mysqli_query($conn, $q);
                                        $i = 1;

                                        while($row = mysqli_fetch_assoc($userQueries)) {
                                            $seenBtn = $row['seen'] == 0 
                                                ? "<a href='?seen={$row['sl_no']}' class='btn btn-sm btn-warning mb-1 w-100'>Mark as Read</a>"
                                                : "<span class='btn btn-sm mb-1 btn-success w-100'>Seen</span>";

                                            echo <<<HTML
                                            <tr>
                                                <th scope="row">{$i}</th>
                                                <td>{$row['name']}</td>
                                                <td>{$row['email']}</td>
                                                <td>{$row['subject']}</td>
                                                <td>{$row['message']}</td>
                                                <td>{$row['date']}</td>
                                                <td>
                                                    {$seenBtn}
                                                    <a href="?del={$row['sl_no']}" class="btn btn-sm btn-danger w-100">Delete</a>
                                                </td>
                                            </tr>
                                            HTML;
                                            $i++;
                                        }

                                        if (mysqli_num_rows($userQueries) == 0) {
                                            echo <<<HTML
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted" style="height: 300px; vertical-align: middle;">
                                                        No user queries found.
                                                    </td>
                                                </tr>                                            
                                            HTML;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Include Common Scripts-->
    <?php require_once('./include/scripts.php'); ?>
</body>

</html>