<?php
    include_once('admin/db/db_config.php');
    include_once('admin/include/essentials.php');
    
    $contact_q = "SELECT * FROM `contact_details` WHERE `sl_no`=?";
    $values = [1];
    $contact_r = mysqli_fetch_assoc(select($contact_q, $values, "i"));
    
    $settings_q = "SELECT * FROM `settings` WHERE `sl_no`=?";
    $values = [1];
    $settings_r = mysqli_fetch_assoc(select($settings_q, $values, "i"));
?>

<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light px-3 py-2 px-lg-3 py-lg-2 w-100 top-0 z-3 sticky">
    <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><?php echo $settings_r['site_title'] ?></a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link me-2" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="rooms.php">Rooms</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="facilities.php">Facilities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-2" href="contact.php">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
            </ul>
            <div class="d-flex" role="search">
                <?php
                    if(isset($_SESSION['login']) && $_SESSION['login'] == true){
                        $path = USERS_IMG_PATH;
                        echo <<<HTML
                            <div class="btn-group">
                                <button type="button" class="btn shadow-none border-0 dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                    <img src="{$path}{$_SESSION['USER_PROFILE']}" alt="{$_SESSION['USER_NAME']}" class="rounded-circle me-1" width="30px" height="30px">
                                    <span class="d-none d-lg-inline">{$_SESSION['USER_NAME']}</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-lg-end">
                                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                        HTML;

                    } else {
                        echo <<<HTML
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal"
                                data-bs-target="#loginModal">
                                Login
                            </button>
                            <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal"
                                data-bs-target="#registerModal">
                                Register
                            </button>
                        HTML;
                    }
                ?>
            </div>
        </div>
    </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="login-form" novalidate>
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
                        <label for="login-email" class="form-label">Email/Mobile</label>
                        <input 
                            type="email" 
                            class="form-control shadow-none" id="login-email" 
                            autoComplete="username"
                            required
                            name="email_mob"
                        >
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <input 
                            type="password" 
                            class="form-control shadow-none" 
                            id="password"
                            autoComplete="current-password"
                            required
                            name="password"
                        >
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
                        <button type="button" class="btn text-secondary text-decoration-none shadow-none p-0 border-0" data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal">
                            Forgot Password?
                        </button>
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
            <form id="register-form" novalidate>
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
                                <input 
                                    type="text" 
                                    class="form-control shadow-none" id="name" 
                                    autocomplete="name" 
                                    required
                                    name="name"
                                >
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="registration-email" class="form-label">Email</label>
                                <input 
                                    type="email" 
                                    class="form-control shadow-none" id="registration-email"
                                    autocomplete="email" 
                                    required
                                    name="email"
                                >
                            </div>
                            <div class="col-md-6 p-0 pe-md-3 mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input 
                                    type="tel" 
                                    class="form-control shadow-none" id="phone" 
                                    autocomplete="tel" 
                                    required
                                    name="phonenumber"
                                >
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="picture" class="form-label">Picture</label>
                                <input 
                                    type="file" 
                                    class="form-control shadow-none" id="picture"
                                    accept="image/png, image/webp, image/jpeg, image/jpg" 
                                    required
                                    name="profile"
                                >
                            </div>
                            <div class="col-md-12 p-0 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea 
                                    class="form-control shadow-none" id="address"
                                    autocomplete="street-address" required
                                    name="address"
                                    rows="3"
                                ></textarea>
                            </div>
                            <div class="col-md-6 p-0 pe-md-3 mb-3">
                                <label for="pincode" class="form-label">Pincode</label>
                                <input 
                                    type="tel" 
                                    class="form-control shadow-none" id="pincode"
                                    autocomplete="postal-code" 
                                    required
                                    name="pincode"
                                >
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input 
                                    type="date" 
                                    class="form-control shadow-none" id="dob" 
                                    autocomplete="bday" 
                                    required
                                    name="dob"
                                >
                            </div>
                            <div class="col-md-6 p-0 pe-md-3 mb-3">
                                <label for="registration-password" class="form-label">Password</label>
                                <input 
                                    type="password" 
                                    class="form-control shadow-none" id="registration-password"
                                    autocomplete="new-password" 
                                    required
                                    name="password"
                                >
                            </div>
                            <div class="col-md-6 p-0 mb-3">
                                <label for="registration-confirm-password" class="form-label">Confirm
                                    Password</label>
                                <input 
                                    type="password" 
                                    class="form-control shadow-none"
                                    id="registration-confirm-password" autocomplete="new-password" 
                                    required
                                    name="cpassword"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
                        <button type="button" class="btn border-0 shadow-none p-0 me-2 text-secondary text-decoration-none" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
                            Already have an account?
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Forgot Modal -->
<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="forgot-form" novalidate>
                <div class="modal-header">
                    <h1 class="modal-title fs-5 d-flex align-items-center">
                        <i class="bi bi-person-circle fs-3 me-2"></i>
                        Forgot Password
                    </h1>
                </div>
                <div class="modal-body">
                    <span class="badge rounded-pill text-bg-light text-dark mb-3 text-wrap lh-base">
                        Note: A link will be sent to your email to reset your password!
                    </span>
                    <div class="mb-4">
                        <label for="login-email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            class="form-control shadow-none" id="login-email" 
                            autoComplete="username"
                            required
                            name="email"
                        >
                    </div>
                    <div class="text-end mb-2">
                        <button type="button" class="btn border-0 shadow-none p-0 me-2" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
                                CANCEL
                        </button>
                        <button type="submit" class="btn btn-dark shadow-none">SEND LINK</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>