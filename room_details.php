<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MH Hotel - Room Details</title>
    <!-- Common Links -->
    <?php require_once('./include/links.php'); ?>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <?php require_once('./include/header.php'); ?>

    <!-- Check id is present or not -->
    <?php
        if (!isset($_GET['id'])) {
            redirect('rooms.php');
            exit;
        }

        $data = filteration($_GET);

        $room_data = select("SELECT * FROM `rooms` WHERE `sl_no`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], "iii");

        if (mysqli_num_rows($room_data) == 0) {
            redirect('rooms.php');
            exit;
        }
        $room_data = mysqli_fetch_assoc($room_data);
    ?>

    <div class="container">
        <div class="row">
            <!--Heading-->
            <div class="col-12 my-5 mb-4 px-4">
                <h2 class="fw-bold">
                    <?php echo $room_data['name']; ?>
                </h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-decoration-none text-dark">HOME</a> &nbsp; > &nbsp;
                    <a href="rooms.php" class="text-decoration-none text-dark">ROOMS</a> &nbsp; > &nbsp;
                    <span class="text-secondary text-uppercase">
                        <?php echo $room_data['name']; ?>
                    </span>
                </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4">
                <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                            // get images of room
                            $room_img = ROOMS_IMG_PATH."thumbnail.jpg";

                            $img_q = mysqli_query($conn, "SELECT * FROM `room_image` WHERE `room_id` = '{$room_data['sl_no']}'");

                            if(mysqli_num_rows($img_q) > 0){
                                $active_class = "active";
                                while($img_res = mysqli_fetch_assoc($img_q)){
                                    echo"
                                        <div class='carousel-item $active_class'>
                                            <img src='".ROOMS_IMG_PATH.$img_res['image']."' class='d-block w-100 rounded'>
                                        </div>
                                    ";
                                    $active_class = "";
                                }
                            } else {
                                echo"
                                    <div class='carousel-item active'>
                                        <img src='$room_img' class='d-block w-100'>
                                    </div>
                                ";
                            }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-lg-5 col-md-12 px-4 mt-4 mt-lg-0">
                <div class="card p-2 mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <?php
                            echo<<<price
                                <h4 class="mb-3">₹$room_data[price] per night</h4>
                            price;

                            echo<<<rating
                                <div class="rating mb-3 d-flex">
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-warning"></i>
                                    <i class="bi bi-star-fill text-secondary"></i>
                                    <i class="bi bi-star-fill text-secondary"></i>
                                </div>
                            rating;

                            $fea_q = mysqli_query($conn, "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea ON f.sl_no = rfea.features_id WHERE rfea.room_id = '{$room_data['sl_no']}'");

                            $feature_data = "";

                            while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                                $feature_data .= "
                                    <span class='badge rounded-pill text-bg-light text-dark text-wrap'>
                                        $fea_row[name]
                                    </span>
                                ";
                            }

                            echo<<<features
                                <div class="features mb-3">
                                    <h6 class="mb-1">Features</h6>
                                    $feature_data
                                </div>
                            features;

                            // get facilities of room
                            $fac_q = mysqli_query($conn, "SELECT f.name FROM `facilities` f INNER JOIN `room_facilities` rfac ON f.sl_no = rfac.facilities_id WHERE rfac.room_id = '{$room_data['sl_no']}'");

                            $facilities_data = "";
                            while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                                $facilities_data .= "
                                    <span class='badge rounded-pill text-bg-light text-dark text-wrap'>
                                        $fac_row[name]
                                    </span>
                                ";
                            }

                            echo<<<facilities
                                <div class="mb-3">
                                    <h6 class="mb-1">Facilities</h6>
                                    $facilities_data
                                </div>
                            facilities;

                            echo<<<guests
                                <div class="features mb-3">
                                    <h6 class="mb-1">Guests</h6>
                                    <span class='badge rounded-pill text-bg-light text-dark text-wrap'>
                                        $room_data[adult] Adults
                                    </span>
                                    <span class='badge rounded-pill text-bg-light text-dark text-wrap'>
                                        $room_data[children] Childrens
                                    </span>
                                </div>
                            guests;

                            echo<<<area
                                <div class="mb-3">
                                    <h6 class="mb-1">Area</h6>
                                    $room_data[area] sq. ft.
                                </div>
                            area;

                            $login = 0;
                            // ckeck login user
                            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                                $login = 1;
                            }

                            $is_shutdown = $settings_r['shutdown'];
                            $book_button = $is_shutdown
                                ? '<button class="btn btn-sm btn-secondary shadow-none py-2 flex-fill" disabled>Booking Disabled</button>'
                                : '<button onclick="checkLoginToBook(' . $login . ', ' . $room_data['sl_no'] . ');" class="btn btn-sm text-white custom-bg shadow-none py-2 flex-fill">Book Now</button>';

                            echo <<<book
                                <div class="d-flex flex-md-row gap-2">
                                    $book_button
                                    <a href="rooms.php" class="btn  btn-outline-dark shadow-none py-3 w-50"><<< Back</a>
                                </div>
                            book;
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4 px-4">
                <div class="mb-5">
                    <h5>Description</h5>
                    <p>
                        <?php echo $room_data['description']; ?>
                    </p>
                </div>

                <div>
                    <h5 class="mb-3">Review & Ratings</h5>
                    <div>
                    <div class="d-flex align-items-center mb-2">
                            <img src="./images/others/wifi.svg" width="30px">
                            <h6 class="m-0 ms-2">Jhon Doe</h6>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, voluptatem?</p>
                        <div class="rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                </div>
            </div>
                
            </div>

           
        </div>
    </div>

    <!--Footer-->
    <?php require_once('./include/footer.php'); ?>

    <!--Include Common Scripts-->
    <?php require_once('./include/scripts.php'); ?>
</body>

</html>