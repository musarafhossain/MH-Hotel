<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MH Hotel - Home</title>
    <!-- Swiper JS Style Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Common Links -->
    <?php require_once('./include/links.php'); ?>
    <style>
        .availability-form {
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }

        @media screen and (max-width: 575px) {
            .availability-form {
                margin-top: 25px;
                padding: 0 35px;
            }
        }

        .fade-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 10%;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
            pointer-events: none;
        }

        .fade-top {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(to top, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
        }

        .facilities-bg {
            background-color: #e5e5f7;
            opacity: 0.8;
            background-image: radial-gradient(#444cf7 0.5px, #e5e5f7 0.5px);
            background-size: 10px 10px;
        }

        .hero-img {
            max-height: 500px;
            object-fit: cover;
            width: 100%;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(2px);
        }

        .hero-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: 'Bebas Neue', sans-serif;
            color: #ffffff;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 10px 20px;
            z-index: 2;
            width: 90%;
            max-width: 700px;
            font-weight: normal;
            word-wrap: break-word;
            line-height: 1.2;
            text-shadow:
                0 0 3px #ffffffaa,
                0 0 6px #00d9ff,
                0 0 10px #00d9ff;
        }

        @media (max-width: 576px) {
            .hero-text {
                font-size: 2.4rem;
            }
        }

        @media (min-width: 576px) {
            .hero-text {
                font-size: 2.7rem;
            }
        }

        @media (min-width: 842px) and (max-width: 991px) {
            .hero-text {
                font-size: 4.5rem;
            }
        }

        @media (min-width: 992px) {
            .hero-text {
                font-size: 5.5rem;
            }
        }

        @media (min-width: 1350px) {
            .hero-text {
                font-size: 6rem;
            }
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <?php require_once('./include/header.php'); ?>

    <!-- Hero Section -->
    <div class="">
        <div class="swiper swiper-hero">
            <div class="swiper-wrapper">
                <?php
                    $res = selectAll('carousel');
                    $settings = mysqli_fetch_assoc(selectAll('settings')); // Fetch settings once
                    $path = CAROUSEL_IMG_PATH;

                    while ($row = mysqli_fetch_assoc($res)) {
                        echo <<<HTML
                            <div class="swiper-slide position-relative">
                                <img src="{$path}{$row['image']}" class="w-100 hero-img d-block" />
                                <div class="hero-overlay"></div>
                                <h1 class="hero-text">{$settings['site_heading']}</h1>
                                <div class="fade-bottom"></div>
                            </div>
                        HTML;
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- Check Availability Form -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white shadow p-4 rounded">
                <h5 class="mb-4">Check Booking Availibility</h5>
                <form action="#">
                    <div class="row align-items-end">
                        <div class="col-lg-3 mb-3">
                            <label for="check-in" class="form-label" style="font-weight: 500;">Check-in</label>
                            <input type="date" class="form-control shadow-none" id="check-in">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="check-out" class="form-label" style="font-weight: 500;">Check-out</label>
                            <input type="date" class="form-control shadow-none" id="check-out">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label for="adults" class="form-label">Adults</label>
                            <select class="form-select shadow-none" id="adults">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label for="children" class="form-label">Children</label>
                            <select class="form-select shadow-none" id="children">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mt-2 mb-lg-3">
                            <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Our Rooms -->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
    <div class="container">
        <div class="row">
            <?php
            $room_data = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `sl_no` DESC LIMIT 3", [1, 0], "ii");

            while ($room_row = mysqli_fetch_assoc($room_data)) {
                // Features
                $fea_q = mysqli_query($conn, "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea ON f.sl_no = rfea.features_id WHERE rfea.room_id = '{$room_row['sl_no']}'");
                $feature_data = "";
                while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                    $feature_data .= "<span class='badge rounded-pill text-bg-light text-dark text-wrap me-1 mb-1'>{$fea_row['name']}</span>";
                }

                // Facilities
                $fac_q = mysqli_query($conn, "SELECT f.name FROM `facilities` f INNER JOIN `room_facilities` rfac ON f.sl_no = rfac.facilities_id WHERE rfac.room_id = '{$room_row['sl_no']}'");
                $facilities_data = "";
                while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                    $facilities_data .= "<span class='badge rounded-pill text-bg-light text-dark text-wrap me-1 mb-1'>{$fac_row['name']}</span>";
                }

                // Thumbnail
                $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                $thumb_q = mysqli_query($conn, "SELECT * FROM `room_image` WHERE `room_id` = '{$room_row['sl_no']}' AND `thumb` = 1");
                if (mysqli_num_rows($thumb_q) > 0) {
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                }

                $is_shutdown = $settings_r['shutdown'];
                $book_button = $is_shutdown
                    ? '<button class="btn btn-sm btn-secondary shadow-none py-2 flex-fill" disabled>Booking Disabled</button>'
                    : '<a href="#" class="btn btn-sm text-white custom-bg shadow-none py-2 flex-fill">Book Now</a>';

                // Room Card
                echo <<<data
                    <div class="col-lg-4 col-md-6 my-3">
                        <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                            <img src="$room_thumb" class="card-img-top" alt="Room Image">
                            <div class="card-body">
                                <h6>{$room_row['name']}</h6>
                                <h5 class="mb-2">₹{$room_row['price']} per night</h5>
                                <hr class="my-2">
                                <div class="features mb-2">
                                    <h6 class="mb-1">Features</h6>
                                    $feature_data
                                </div>
                                <hr class="my-2">
                                <div class="facilities mb-2">
                                    <h6 class="mb-1">Facilities</h6>
                                    $facilities_data
                                </div>
                                <hr class="my-2">
                                <div class="guests mb-2">
                                    <h6 class="mb-1">Guests</h6>
                                    <span class="badge rounded-pill text-bg-light text-dark text-wrap me-1">
                                        {$room_row['adult']} Adults
                                    </span>
                                    <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                        {$room_row['children']} Children
                                    </span>
                                </div>
                                <hr class="my-2">
                                <div class="rating mb-3 d-flex align-items-center gap-2">
                                    <h6 class="mb-0">Rating :</h6>
                                    <span class="badge rounded-pill bg-light">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-secondary"></i>
                                        <i class="bi bi-star-fill text-secondary"></i>
                                    </span>
                                </div>
                                <div class="d-flex gap-2">
                                    $book_button
                                    <a href="room_details.php?id={$room_row['sl_no']}" class="btn btn-sm btn-outline-dark shadow-none py-2 flex-fill">More details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                data;
            }
            ?>
            <div class="col-12 text-center mt-lg-5 mt-3">
                <a href="rooms.php" class="btn btn-sm btn-outline-dark fw-bold shadow-none py-2">More Rooms >>></a>
            </div>
        </div>
    </div>

    <!--Our Falilities-->
    <div class="facilities-bg pb-4">
        <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
        <div class="container">
            <div class="row justify-content-evenly px-lg-0 p-md-0 px-5 gap-2">
                <?php
                    $res = mysqli_query($conn, "SELECT * FROM facilities ORDER BY `sl_no` DESC LIMIT 5");
                    $path = FACILITIES_IMG_PATH;

                    while ($row = mysqli_fetch_assoc($res)) {
                        echo<<<data
                            <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                                <img src="$path$row[icon]" alt="" srcset="" width="80px">
                                <h5 class="mt-3">$row[name]</h5>
                            </div>
                        data;
                    }
                ?>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <h2 class="mt-5 pt-4 mb-5 text-center fw-bold h-font">TESTIMONIALS</h2>
    <div class="container mt-5">
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper mb-5">
                <div class="swiper-slide bg-white p-4 border">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="./images/others/wifi.svg" width="30px">
                        <h6 class="m-0 ms-2">Jhon Doe</h6>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, voluptatem?</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4 border">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="./images/others/wifi.svg" width="30px">
                        <h6 class="m-0 ms-2">Jhon Doe</h6>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, voluptatem?</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4 border">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="./images/others/wifi.svg" width="30px">
                        <h6 class="m-0 ms-2">Jhon Doe</h6>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, voluptatem?</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4 border">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="./images/others/wifi.svg" width="30px">
                        <h6 class="m-0 ms-2">Jhon Doe</h6>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, voluptatem?</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4 border">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="./images/others/wifi.svg" width="30px">
                        <h6 class="m-0 ms-2">Jhon Doe</h6>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, voluptatem?</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
                <div class="swiper-slide bg-white p-4 border">
                    <div class="profile d-flex align-items-center mb-3">
                        <img src="./images/others/wifi.svg" width="30px">
                        <h6 class="m-0 ms-2">Jhon Doe</h6>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, voluptatem?</p>
                    <div class="rating">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Google Map -->
    <h2 class="mt-5 pt-4 mb-5 text-center fw-bold h-font">REACH US</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded border">
                <iframe src="<?php echo $contact_r['iframe'] ?>" height="320" class="w-100 rounded"
                    loading="lazy"></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-2 border">
                    <h5>Call Us</h5>
                    <a href="tel:<?php echo $contact_r['phone'] ?>"
                        class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i>
                        <?php echo $contact_r['phone'] ?>
                    </a>
                    <br>
                    <h5 class="mt-4">Email</h5>
                    <a href="mailto:<?php echo $contact_r['email'] ?>"
                        class="d-flex gap-2 mb-2 text-decoration-none text-dark">
                        <i class="bi bi-envelope-fill"></i>
                        <?php echo $contact_r['email'] ?>
                    </a>
                </div>
                <div class="bg-white p-4 rounded mb-4 gap-2 border">
                    <h5>Follow Us</h5>
                    <div class="d-flex gap-2">
                        <a href="<?php echo $contact_r['facebook'] ?>" target="_blank"
                            class="d-inline-block mb-2 text-decoration-none text-dark">
                            <i class="bi bi-facebook text-dark fs-5"></i>
                        </a>
                        <a href="<?php echo $contact_r['instagram'] ?>" target="_blank"
                            class="d-inline-block mb-2 text-decoration-none">
                            <i class="bi bi-instagram text-dark fs-5"></i>
                        </a>
                        <a href="<?php echo $contact_r['twitter'] ?>" target="_blank"
                            class="d-inline-block mb-2 text-decoration-none text-info">
                            <i class="bi bi-twitter text-dark fs-5"></i>
                        </a>
                        <a href="<?php echo $contact_r['youtube'] ?>" target="_blank"
                            class="d-inline-block mb-2 text-decoration-none">
                            <i class="bi bi-youtube text-dark fs-5"></i>
                        </a>
                        <a href="<?php echo $contact_r['linkedin'] ?>" target="_blank"
                            class="d-inline-block mb-2 text-decoration-none">
                            <i class="bi bi-linkedin text-dark fs-5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Footer-->
    <?php require_once('./include/footer.php'); ?>

    <!--Include Common Scripts-->
    <?php require_once('./include/scripts.php'); ?>
    <!-- Swiper JS Script Link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiperHero = new Swiper(".swiper-hero", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            },
        });

        var swiperTestimonials = new Swiper(".swiper-testimonials", {
            effect: "coverflow",
            loop: true,
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            slidesPerView: "3",
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>

</body>

</html>