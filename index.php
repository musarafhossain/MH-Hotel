<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MH - Hotel</title>
    <!-- Bootstrap Style Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Google Font (Merienda[300-900], Poppins[400, 500, 600]) -->
    <link href="https://fonts.googleapis.com/css2?family=Merienda:wght@300..900&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Bootstrap Icon Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Swiper JS Style Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
        *{
            font-family: 'Poppins', sans-serif;
        }

        .h-font{
            font-family: "Merienda", sans-serif;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button{
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number]{
            -moz-appearance: textfield;
        }

        .custom-bg{
            background-color: #2ec1ac;
        }
        
        .custom-bg:hover{
            background-color: #279e8c;
        }

        .availability-form{
            margin-top: -50px;
            z-index: 2;
            position: relative;
        }

        @media screen and (max-width: 575px) {
            .availability-form{
                margin-top: 25px;
                padding: 0 35px;
            }
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-light bg-white px-3 py-2 px-lg-3 py-lg-2 shadow-sm static-top"
        <div class="container-fluid">
            <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">MH Hotel</a>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Login
                    </button>
                    <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
                        Register
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Swiper -->
    <div class="container-fluid px-lg-4 mt-4">    
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="./images/carousel/image-1.png" class="w-100 d-block"/>
                </div>
                <div class="swiper-slide">
                    <img src="./images/carousel/image-2.png" class="w-100 d-block"/>
                </div>
                <div class="swiper-slide">
                    <img src="./images/carousel/image-3.png" class="w-100 d-block"/>
                </div>
                <div class="swiper-slide">
                    <img src="./images/carousel/image-4.png" class="w-100 d-block"/>
                </div>
                <div class="swiper-slide">
                    <img src="./images/carousel/image-5.png" class="w-100 d-block"/>
                </div>
                <div class="swiper-slide">
                    <img src="./images/carousel/image-6.png" class="w-100 d-block"/>
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

    <br><br><br><br><br><br>
        
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action='#'>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 d-flex align-items-center">
                            <i class="bi bi-person-circle fs-3 me-2"></i>
                            User Login
                        </h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="login-email" class="form-label">Email address</label>
                            <input type="email" class="form-control shadow-none" id="login-email" autoComplete="username">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control shadow-none" id="password" autoComplete="current-password">
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action='#'>
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 d-flex align-items-center">
                            <i class="bi bi-person-lines-fill fs-3 me-2"></i>
                            User Registration
                        </h1>
                        <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <span class="badge rounded-pill text-bg-light text-dark mb-3 text-wrap lh-base">
                            Note: Your details must match with your ID (Aadhaar card, passport, driving license, etc.) that will be required during check-in.
                        </span>
                        <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 p-0 pe-md-3 mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control shadow-none" id="name" autocomplete="name">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="registration-email" class="form-label">Email</label>
                                <input type="email" class="form-control shadow-none" id="registration-email" autocomplete="email">
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
                                <textarea class="form-control shadow-none" id="address" autocomplete="street-address"></textarea>
                            </div>
                            <div class="col-md-6 p-0 pe-md-3 mb-3">
                                <label for="pincode" class="form-label">Pincode</label>
                                <input type="tel" class="form-control shadow-none" id="pincode" autocomplete="postal-code">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control shadow-none" id="dob">
                            </div>
                            <div class="col-md-6 p-0 pe-md-3 mb-3">
                                <label for="registration-password" class="form-label">Password</label>
                                <input type="password" class="form-control shadow-none" id="registration-password" autocomplete="new-password">
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="registration-confirm-password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control shadow-none" id="registration-confirm-password" autocomplete="new-password">
                            </div>
                        </div>
                    </div>

                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
                            <a href="javascript: void(0)" class="text-secondary text-decoration-none">Already have an account?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Script Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Swiper JS Script Link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
               delay: 3500,
               disableOnInteraction: false, 
            },
        });
    </script>
</body>
</html>