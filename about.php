<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MH Hotel - About</title>
    <!-- Swiper JS Style Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Common Links -->
    <?php require_once('./include/links.php'); ?>
    <style>
        .box {
            border-top-color: var(--teal) !important;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <?php require_once('./include/header.php'); ?>

    <!--Heading-->
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">ABOUT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br>Deleniti voluptatum
            totam et eum rem consectetur? Hic labore ipsum alias odio?</p>
    </div>

    <!--About Us Section-->
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">Lorem ipsum dolor sit amet.</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem eum fuga porro sed ullam nobis, ipsum
                    maxime assumenda eius suscipit.</p>
            </div>
            <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
                <img src="images/about/about.jpg" class="w-100">
            </div>
        </div>
    </div>

    <!--Stats Information-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/hotel.svg" width="70px">
                    <h4 class="mt-3">100+ ROOMS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/customers.svg" width="70px">
                    <h4 class="mt-3">400+ CUSTOMERS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/rating.svg" width="70px">
                    <h4 class="mt-3">150+ REVIEWS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded shadow p-4 border-top border-4 text-center box">
                    <img src="images/about/staff.svg" width="70px">
                    <h4 class="mt-3">200+ STAFFS</h4>
                </div>
            </div>
        </div>
    </div>

    <!--Management Section-->
    <h3 class="my-5 fw-bold h-font text-center">MANAGEMENT TEAM</h3>
    <div class="container px-4">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper mb-5">
                <div class="swiper-slide bg-white text-center overflow-hidden rounded shadow">
                    <img src="images/about/IMG_17352.jpg" class="w-100">
                    <h5 class="mt-2">John Doe</h5>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded shadow">
                    <img src="images/about/IMG_17352.jpg" class="w-100">
                    <h5 class="mt-2">John Doe</h5>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded shadow">
                    <img src="images/about/IMG_17352.jpg" class="w-100">
                    <h5 class="mt-2">John Doe</h5>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded shadow">
                    <img src="images/about/IMG_17352.jpg" class="w-100">
                    <h5 class="mt-2">John Doe</h5>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded shadow">
                    <img src="images/about/IMG_17352.jpg" class="w-100">
                    <h5 class="mt-2">John Doe</h5>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded shadow">
                    <img src="images/about/IMG_17352.jpg" class="w-100">
                    <h5 class="mt-2">John Doe</h5>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded shadow">
                    <img src="images/about/IMG_17352.jpg" class="w-100">
                    <h5 class="mt-2">John Doe</h5>
                </div>
                <div class="swiper-slide bg-white text-center overflow-hidden rounded shadow">
                    <img src="images/about/IMG_17352.jpg" class="w-100">
                    <h5 class="mt-2">John Doe</h5>
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
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 4,
            spaceBetween: 40,
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 4,
                },
            },
        });
    </script>
</body>

</html>