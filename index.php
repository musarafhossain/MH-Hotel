<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MH - Hotel</title>
    <!-- Bootstrap Style Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Font (Merienda[300-900], Poppins[400, 500, 600]) -->
    <link
        href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">
    <!-- Bootstrap Icon Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Swiper JS Style Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Common CSS Link -->
    <link rel="stylesheet" href="./css/common.css">
    <style>
        .navbar.sticky {
            position: sticky;
            background-color: #fff !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

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
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light px-3 py-2 px-lg-3 py-lg-2 w-100 top-0 z-3 sticky">
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">MH Hotel</a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active me-2" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Facilities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-2" href="#">Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                </ul>
                <div class="d-flex" role="search">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger shadow-none me-lg-3 me-2" data-bs-toggle="modal"
                        data-bs-target="#loginModal">
                        Login
                    </button>
                    <button type="button" class="btn btn-success shadow-none" data-bs-toggle="modal"
                        data-bs-target="#registerModal">
                        Register
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="">
        <div class="swiper swiper-hero">
            <div class="swiper-wrapper">
                <div class="swiper-slide position-relative">
                    <img src="./images/carousel/image-1.png" class="w-100 d-block" />
                    <div class="fade-bottom"></div>
                </div>
                <div class="swiper-slide position-relative">
                    <img src="./images/carousel/image-2.png" class="w-100 d-block" />
                    <div class="fade-bottom"></div>
                </div>
                <div class="swiper-slide position-relative">
                    <img src="./images/carousel/image-3.png" class="w-100 d-block" />
                    <div class="fade-bottom"></div>
                </div>
                <div class="swiper-slide position-relative">
                    <img src="./images/carousel/image-4.png" class="w-100 d-block" />
                    <div class="fade-bottom"></div>
                </div>
                <div class="swiper-slide position-relative">
                    <img src="./images/carousel/image-5.png" class="w-100 d-block" />
                    <div class="fade-bottom"></div>
                </div>
                <div class="swiper-slide position-relative">
                    <img src="./images/carousel/image-6.png" class="w-100 d-block" />
                    <div class="fade-bottom"></div>
                </div>
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

    <!--Our Rooms-->
    <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR ROOMS</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="./images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Simple Room Name</h5>
                        <h6 class="">₹200 per night</h6>
                        <hr class="my-2">
                        <div class="features">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                2 Rooms
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                1 Balcony
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                3 Sofa
                            </span>
                        </div>
                        <hr class="my-2">
                        <div class="facilities">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                Wifi
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                Television
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                AC
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                Room Heater
                            </span>
                        </div>
                        <hr class="my-2">
                        <div class="rating mb-3 d-flex">
                            <h6 class="mb-1">Rating :</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-secondary"></i>
                                <i class="bi bi-star-fill text-secondary"></i>
                            </span>
                        </div>
                        <div class="mb-2 col-lg-12 d-flex gap-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none py-2 flex-fill">>>> Book
                                Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none py-2 flex-fill">More details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="./images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Simple Room Name</h5>
                        <h6 class="">₹200 per night</h6>
                        <hr class="my-2">
                        <div class="features">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                2 Rooms
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                1 Balcony
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                3 Sofa
                            </span>
                        </div>
                        <hr class="my-2">
                        <div class="facilities">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                Wifi
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                Television
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                AC
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                Room Heater
                            </span>
                        </div>
                        <hr class="my-2">
                        <div class="rating mb-3 d-flex">
                            <h6 class="mb-1">Rating :</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-secondary"></i>
                                <i class="bi bi-star-fill text-secondary"></i>
                            </span>
                        </div>
                        <div class="mb-2 col-lg-12 d-flex gap-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none py-2 flex-fill">>>> Book
                                Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none py-2 flex-fill">More details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 my-3">
                <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
                    <img src="./images/rooms/1.jpg" class="card-img-top">
                    <div class="card-body">
                        <h5>Simple Room Name</h5>
                        <h6 class="">₹200 per night</h6>
                        <hr class="my-2">
                        <div class="features">
                            <h6 class="mb-1">Features</h6>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                2 Rooms
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                1 Bathroom
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                1 Balcony
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                3 Sofa
                            </span>
                        </div>
                        <hr class="my-2">
                        <div class="facilities">
                            <h6 class="mb-1">Facilities</h6>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                Wifi
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                Television
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                AC
                            </span>
                            <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                Room Heater
                            </span>
                        </div>
                        <hr class="my-2">
                        <div class="rating mb-3 d-flex">
                            <h6 class="mb-1">Rating :</h6>
                            <span class="badge rounded-pill bg-light">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-secondary"></i>
                                <i class="bi bi-star-fill text-secondary"></i>
                            </span>
                        </div>
                        <div class="mb-2 col-lg-12 d-flex gap-2">
                            <a href="#" class="btn btn-sm text-white custom-bg shadow-none py-2 flex-fill">>>> Book
                                Now</a>
                            <a href="#" class="btn btn-sm btn-outline-dark shadow-none py-2 flex-fill">More details</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 text-center mt-lg-5 mt-3">
                <a href="# " class="btn btn-sm btn-outline-dark fw-bold shadow-none py-2">More Rooms >>></a>
            </div>
        </div>
    </div>

    <!--Our Falilities-->
    <div class="facilities-bg pb-4">
        <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">OUR FACILITIES</h2>
        <div class="container">
            <div class="row justify-content-evenly px-lg-0 p-md-0 px-5 gap-2">
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                    <img src="./images/facilities/wifi.svg" alt="" srcset="" width="80px">
                    <h5 class="mt-3">Wifi</h5>
                </div>
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                    <img src="./images/facilities/tv.svg" alt="" srcset="" width="80px">
                    <h5 class="mt-3">TV</h5>
                </div>
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                    <img src="./images/facilities/ac.svg" alt="" srcset="" width="80px">
                    <h5 class="mt-3">AC</h5>
                </div>
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                    <img src="./images/facilities/heater.svg" alt="" srcset="" width="80px">
                    <h5 class="mt-3">Heater</h5>
                </div>
                <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
                    <img src="./images/facilities/massage.svg" alt="" srcset="" width="80px">
                    <h5 class="mt-3">Massage</h5>
                </div>
                <div class="col-lg-12 text-center mt-lg-5 mt-3">
                    <a href="# " class="btn btn-sm btn-outline-dark fw-bold shadow-none py-2">More Facilities >>></a>
                </div>
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
                        <img src="./images/facilities/wifi.svg" width="30px">
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
                        <img src="./images/facilities/wifi.svg" width="30px">
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
                        <img src="./images/facilities/wifi.svg" width="30px">
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
                        <img src="./images/facilities/wifi.svg" width="30px">
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
                        <img src="./images/facilities/wifi.svg" width="30px">
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
                        <img src="./images/facilities/wifi.svg" width="30px">
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d235850.8127278619!2d88.18219205572203!3d22.5353430840448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f882db4908f667%3A0x43e330e68f6c2cbc!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1744302371153!5m2!1sen!2sin" height="320" class="w-100 rounded" loading="lazy" ></iframe>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="bg-white p-4 rounded mb-4 border">
                    <h5>Call Us</h5>
                    <a href="tel:+919998887771" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i>
                        +91-9998887771
                    </a>
                    <br>
                    <a href="tel:+919998887771" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i>
                        +91-9998887771
                    </a>
                </div>
                <div class="bg-white p-4 rounded mb-4 gap-2 border">
                    <h5>Follow Us</h5>
                    <div class="d-flex gap-2">
                        <a href="#" class="d-inline-block mb-2 text-decoration-none text-dark">
                            <i class="bi bi-facebook text-primary fs-3"></i>
                        </a>
                        <a href="#" class="d-inline-block mb-2 text-decoration-none">
                            <i class="bi bi-instagram text-danger fs-3"></i>
                        </a>
                        <a href="#" class="d-inline-block mb-2 text-decoration-none text-info">
                            <i class="bi bi-twitter text-primary fs-3"></i>
                        </a>
                        <a href="#" class="d-inline-block mb-2 text-decoration-none">
                            <i class="bi bi-youtube text-danger fs-3"></i>
                        </a>
                        <a href="#" class="d-inline-block mb-2 text-decoration-none">
                            <i class="bi bi-linkedin text-primary fs-3"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Footer-->
    <footer class="container-fluid bg-white mt-5">
        <div class="row col-lg-12">
            <div class="col-lg-3 p-4">
                <h3 class="h-font fw-bold fs-3 mb-2">TJ HOTEL</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore suscipit itaque at vero consectetur? Minus!</p>
            </div>
            <div class="col-lg-3 p-4">
                <h5 class="mb-3">Links</h5>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    Home
                </a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    Rooms
                </a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    Facilities
                </a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    Contact Us
                </a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    About
                </a>
            </div>
            <div class="col-lg-3 p-4">
                <h5 class="mb-3">Follow Us</h5>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    <i class="bi bi-facebook"></i>
                    Facebook
                </a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    <i class="bi bi-twitter"></i>
                    Twitter
                </a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    <i class="bi bi-instagram"></i>
                    Instagram
                </a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    <i class="bi bi-linkedin"></i>
                    Linkedin
                </a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    <i class="bi bi-youtube"></i>
                    Youtube
                </a><br>
            </div>
            <div class="col-lg-3 p-4">
                <h5 class="mb-3">Others</h5>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    Go to
                </a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    Finder
                </a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    Glocose
                </a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    Category
                </a><br>
                <a href="#" class="d-inline-block mb-2 text-dark text-decoration-none">
                    About
                </a>
            </div>
        </div>
        <div class="row">
            <h6 class="text-center bg-dark text-white p-3 m-0">Designed and Developed by MH Hotel</h6>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action='#'>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 d-flex align-items-center">
                            <i class="bi bi-person-circle fs-3 me-2"></i>
                            User Login
                        </h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="login-email" class="form-label">Email address</label>
                            <input type="email" class="form-control shadow-none" id="login-email"
                                autoComplete="username">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control shadow-none" id="password"
                                autoComplete="current-password">
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot
                                Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action='#'>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 d-flex align-items-center">
                            <i class="bi bi-person-lines-fill fs-3 me-2"></i>
                            User Registration
                        </h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill text-bg-light text-dark mb-3 text-wrap lh-base">
                            Note: Your details must match with your ID (Aadhaar card, passport, driving license, etc.)
                            that will be required during check-in.
                        </span>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6 p-0 pe-md-3 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control shadow-none" id="name" autocomplete="name">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label for="registration-email" class="form-label">Email</label>
                                    <input type="email" class="form-control shadow-none" id="registration-email"
                                        autocomplete="email">
                                </div>
                                <div class="col-md-6 p-0 pe-md-3 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control shadow-none" id="phone" autocomplete="tel">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label for="picture" class="form-label">Picture</label>
                                    <input type="file" class="form-control shadow-none" id="picture">
                                </div>
                                <div class="col-md-12 p-0 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control shadow-none" id="address"
                                        autocomplete="street-address"></textarea>
                                </div>
                                <div class="col-md-6 p-0 pe-md-3 mb-3">
                                    <label for="pincode" class="form-label">Pincode</label>
                                    <input type="tel" class="form-control shadow-none" id="pincode"
                                        autocomplete="postal-code">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control shadow-none" id="dob">
                                </div>
                                <div class="col-md-6 p-0 pe-md-3 mb-3">
                                    <label for="registration-password" class="form-label">Password</label>
                                    <input type="password" class="form-control shadow-none" id="registration-password"
                                        autocomplete="new-password">
                                </div>
                                <div class="col-md-6 p-0 mb-3">
                                    <label for="registration-confirm-password" class="form-label">Confirm
                                        Password</label>
                                    <input type="password" class="form-control shadow-none"
                                        id="registration-confirm-password" autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Already have an
                                account?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Script Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
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