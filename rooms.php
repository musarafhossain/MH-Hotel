<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MH Hotel - Rooms</title>
    <!-- Common Links -->
    <?php require_once('./include/links.php'); ?>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <?php require_once('./include/header.php'); ?>

    <!--Heading-->
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR ROOMS</h2>
        <div class="h-line bg-dark"></div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4">
                <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow">
                    <div class="container-fluid flex-lg-column d-flex">
                        <h4 class="mt-2 text-left">FILTERS</h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                            data-bs-target="#filterDropdown" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <i class="bi bi-filter fs-1"></i>
                        </button>
                        <div style="width: 100%;" class="collapse navbar-collapse flex-column align-items-stretch mt-2"
                            id="filterDropdown">
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">CHECK AVAIBILITY</h5>
                                <label class="form-label"> Check-in</label>
                                <input type="date" class="form-control shadow-none mb-3">
                                <label class="form-label"> Check-out</label>
                                <input type="date" class="form-control shadow-none">
                            </div>
                            <div class="border bg-light p-3 rounded mb-3">
                                <h5 class="mb-3" style="font-size: 18px;">FACILITIES</h5>
                                <div class="mb-2">
                                    <input type="checkbox" id="f1" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f1">Facility one</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f2" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f2">Facility two</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f3" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f3">Facility three</label>
                                </div>
                            </div>
                            <div class="border bg-light p-3 rounded">
                                <h5 class="mb-3" style="font-size: 18px;">GUESTS</h5>
                                <div class="d-flex gap-2">
                                    <div>
                                        <label class="form-label">Adults</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                    <div>
                                        <label class="form-label">Children</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9 col-md-12">
                <div class="card mb-4 border-0 shadow p-3">
                    <div class="row g-0 p-0 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="./images/rooms/1.jpg" class="img-fluid rounded">
                        </div>
                        <div class="col-md-5 px-lg-4 px-md-4 px-0 my-auto">
                            <h5 class="mb-3">Simple Room Name</h5>
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
                            <div class="features">
                                <h6 class="mb-1">Guests</h6>
                                <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                    5 Adults
                                </span>
                                <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                    3 Childrens
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
                        </div>
                        <div class="col-12 col-md-2 text-md-center text-start mt-md-0 mt-lg-0 mt-2">
                            <h5 class="mb-4">₹200 per night</h5>
                            <div class="d-flex flex-md-column flex-row gap-2">
                                <a href="#" class="btn btn-sm text-white custom-bg shadow-none py-2 flex-fill">Book Now</a>
                                <a href="#" class="btn btn-sm btn-outline-dark shadow-none py-2 flex-fill">More details</a>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="card mb-4 border-0 shadow p-3">
                    <div class="row g-0 p-0 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="./images/rooms/1.jpg" class="img-fluid rounded">
                        </div>
                        <div class="col-md-5 px-lg-4 px-md-4 px-0 my-auto">
                            <h5 class="mb-3">Simple Room Name</h5>
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
                            <div class="features">
                                <h6 class="mb-1">Guests</h6>
                                <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                    5 Adults
                                </span>
                                <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                    3 Childrens
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
                        </div>
                        <div class="col-12 col-md-2 text-md-center text-start mt-md-0 mt-lg-0 mt-2">
                            <h5 class="mb-4">₹200 per night</h5>
                            <div class="d-flex flex-md-column flex-row gap-2">
                                <a href="#" class="btn btn-sm text-white custom-bg shadow-none py-2 flex-fill">Book Now</a>
                                <a href="#" class="btn btn-sm btn-outline-dark shadow-none py-2 flex-fill">More details</a>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="card mb-4 border-0 shadow p-3">
                    <div class="row g-0 p-0 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="./images/rooms/1.jpg" class="img-fluid rounded">
                        </div>
                        <div class="col-md-5 px-lg-4 px-md-4 px-0 my-auto">
                            <h5 class="mb-3">Simple Room Name</h5>
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
                            <div class="features">
                                <h6 class="mb-1">Guests</h6>
                                <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                    5 Adults
                                </span>
                                <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                    3 Childrens
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
                        </div>
                        <div class="col-12 col-md-2 text-md-center text-start mt-md-0 mt-lg-0 mt-2">
                            <h5 class="mb-4">₹200 per night</h5>
                            <div class="d-flex flex-md-column flex-row gap-2">
                                <a href="#" class="btn btn-sm text-white custom-bg shadow-none py-2 flex-fill">Book Now</a>
                                <a href="#" class="btn btn-sm btn-outline-dark shadow-none py-2 flex-fill">More details</a>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="card mb-4 border-0 shadow p-3">
                    <div class="row g-0 p-0 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="./images/rooms/1.jpg" class="img-fluid rounded">
                        </div>
                        <div class="col-md-5 px-lg-4 px-md-4 px-0 my-auto">
                            <h5 class="mb-3">Simple Room Name</h5>
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
                            <div class="features">
                                <h6 class="mb-1">Guests</h6>
                                <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                    5 Adults
                                </span>
                                <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                    3 Childrens
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
                        </div>
                        <div class="col-12 col-md-2 text-md-center text-start mt-md-0 mt-lg-0 mt-2">
                            <h5 class="mb-4">₹200 per night</h5>
                            <div class="d-flex flex-md-column flex-row gap-2">
                                <a href="#" class="btn btn-sm text-white custom-bg shadow-none py-2 flex-fill">Book Now</a>
                                <a href="#" class="btn btn-sm btn-outline-dark shadow-none py-2 flex-fill">More details</a>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="card mb-4 border-0 shadow p-3">
                    <div class="row g-0 p-0 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="./images/rooms/1.jpg" class="img-fluid rounded">
                        </div>
                        <div class="col-md-5 px-lg-4 px-md-4 px-0 my-auto">
                            <h5 class="mb-3">Simple Room Name</h5>
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
                            <div class="features">
                                <h6 class="mb-1">Guests</h6>
                                <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                    5 Adults
                                </span>
                                <span class="badge rounded-pill text-bg-light text-dark text-wrap">
                                    3 Childrens
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
                        </div>
                        <div class="col-12 col-md-2 text-md-center text-start mt-md-0 mt-lg-0 mt-2">
                            <h5 class="mb-4">₹200 per night</h5>
                            <div class="d-flex flex-md-column flex-row gap-2">
                                <a href="#" class="btn btn-sm text-white custom-bg shadow-none py-2 flex-fill">Book Now</a>
                                <a href="#" class="btn btn-sm btn-outline-dark shadow-none py-2 flex-fill">More details</a>
                            </div>                            
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