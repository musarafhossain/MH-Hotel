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
    <?php
        $contact_q = "SELECT * FROM `contact_details` WHERE `sl_no`=?";
        $values = [1];
        $contact_r = mysqli_fetch_assoc(select($contact_q, $values, "i"));
    ?>
    <div class="container">
        <div class="row">
            <!--Address Details-->
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4">
                    <div class="d-flex align-items-center mb-3">
                        <iframe src="<?php echo $contact_r['iframe'] ?>" height="320" class="w-100 rounded" loading="lazy" ></iframe>
                    </div>
                    <h5>Address</h5>
                    <a class="d-flex gap-2 text-decoration-none text-black" target="_blank" href="<?php echo $contact_r['gmap'] ?>">
                        <i class="bi bi-geo-alt-fill"></i>
                        <address><?php echo $contact_r['address'] ?></address>
                    </a>
                    <h5 class="mt-4">Call Us</h5>
                    <a href="tel:<?php echo $contact_r['phone'] ?>" class="d-flex gap-2 mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i>
                        <?php echo $contact_r['phone'] ?>
                    </a>
                    <h5 class="mt-4">Email</h5>
                    <a href="mailto:<?php echo $contact_r['email'] ?>" class="d-flex gap-2 mb-2 text-decoration-none text-dark">
                        <i class="bi bi-envelope-fill"></i>
                        <?php echo $contact_r['email'] ?>
                    </a>
                    <h5 class="mt-4">Follow Us</h5>
                    <div class="d-flex gap-2">
                        <a href="<?php echo $contact_r['facebook'] ?>" target="_blank" class="d-inline-block mb-2 text-decoration-none text-dark">
                            <i class="bi bi-facebook text-dark fs-5"></i>
                        </a>
                        <a href="<?php echo $contact_r['instagram'] ?>" target="_blank" class="d-inline-block mb-2 text-decoration-none">
                            <i class="bi bi-instagram text-dark fs-5"></i>
                        </a>
                        <a href="<?php echo $contact_r['twitter'] ?>" target="_blank" class="d-inline-block mb-2 text-decoration-none text-info">
                            <i class="bi bi-twitter text-dark fs-5"></i>
                        </a>
                        <a href="<?php echo $contact_r['youtube'] ?>" target="_blank" class="d-inline-block mb-2 text-decoration-none">
                            <i class="bi bi-youtube text-dark fs-5"></i>
                        </a>
                        <a href="<?php echo $contact_r['linkedin'] ?>" target="_blank" class="d-inline-block mb-2 text-decoration-none">
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