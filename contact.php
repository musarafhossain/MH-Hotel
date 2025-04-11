<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MH Hotel - Contact Us</title>
    <!-- Common Links -->
    <?php require_once('./include/links.php'); ?>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <?php require_once('./include/header.php'); ?>

    <!--Heading-->
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">CONTACT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. <br>Deleniti voluptatum totam et eum rem consectetur? Hic labore ipsum alias odio?</p>
    </div>
    
    <!--Contact us Section-->
    <div class="container">
        <div class="row">
            <!--Address Details-->
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <div class="d-flex align-items-center mb-3">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d235850.8127278619!2d88.18219205572203!3d22.5353430840448!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39f882db4908f667%3A0x43e330e68f6c2cbc!2sKolkata%2C%20West%20Bengal!5e0!3m2!1sen!2sin!4v1744302371153!5m2!1sen!2sin" height="320" class="w-100 rounded" loading="lazy" ></iframe>
                    </div>
                    <h5>Address</h5>
                    <div class="d-flex gap-2">
                        <i class="bi bi-geo-alt-fill"></i>
                        <address>Kalyani, Kolkata, West Bengal, 700001</address>
                    </div>
                    <h5 class="mt-4">Call Us</h5>
                    <a href="tel:+919998887771" class="d-flex gap-2 mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i>
                        +91-9998887771
                    </a>
                    <h5 class="mt-4">Email</h5>
                    <a href="mailto:mhhotelofficial@gmail.com" class="d-flex gap-2 mb-2 text-decoration-none text-dark">
                        <i class="bi bi-envelope-fill"></i>
                        mhhotelofficial@gmail.com
                    </a>
                    <h5 class="mt-4">Follow Us</h5>
                    <div class="d-flex gap-2">
                        <a href="#" class="d-inline-block mb-2 text-decoration-none text-dark">
                            <i class="bi bi-facebook text-dark fs-5"></i>
                        </a>
                        <a href="#" class="d-inline-block mb-2 text-decoration-none">
                            <i class="bi bi-instagram text-dark fs-5"></i>
                        </a>
                        <a href="#" class="d-inline-block mb-2 text-decoration-none text-info">
                            <i class="bi bi-twitter text-dark fs-5"></i>
                        </a>
                        <a href="#" class="d-inline-block mb-2 text-decoration-none">
                            <i class="bi bi-youtube text-dark fs-5"></i>
                        </a>
                        <a href="#" class="d-inline-block mb-2 text-decoration-none">
                            <i class="bi bi-linkedin text-dark fs-5"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!--Contact us form-->
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <form action="">
                        <h5>Send a message</h5>
                        <div class="mb-3 mt-4">
                            <label for="contact-name" class="form-label" style="font-weight: 500;">Name</label>
                            <input type="name" class="form-control shadow-none" id="contact-name" autoComplete="username">
                        </div>
                        <div class="mb-3">
                            <label for="contact-email" class="form-label" style="font-weight: 500;">Email</label>
                            <input type="email" class="form-control shadow-none" id="contact-email" autoComplete="username">
                        </div>
                        <div class="mb-3">
                            <label for="contact-subject" class="form-label" style="font-weight: 500;">Subject</label>
                            <input type="text" class="form-control shadow-none" id="contact-subject" autoComplete="subject">
                        </div>
                        <div class="mb-3">
                            <label for="contact-message" class="form-label" style="font-weight: 500;">Message</label>
                            <textarea class="form-control shadow-none" id="contact-message" rows="5" style="resize: none;" autocomplete="message"></textarea>
                        </div>
                        <button type="submit" class="btn text-white custom-bg gap-2 d-flex shadow-none" style="font-weight: 500;">
                            SEND
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                    </form>
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