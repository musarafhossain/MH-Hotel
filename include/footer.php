<!-- Manage Nav Links Active -->
<script>
    function setActive() {
        let navbar = document.getElementById('nav-bar');
        let a_tags = navbar.getElementsByTagName('a');

        for (let i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if (document.location.href.indexOf(file_name) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }

    let register_form = document.getElementById('register-form');

    register_form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Collect form values
        let name = register_form.elements['name'].value.trim();
        let email = register_form.elements['email'].value.trim();
        let phone = register_form.elements['phonenumber'].value.trim();
        let password = register_form.elements['password'].value.trim();
        let cpassword = register_form.elements['cpassword'].value.trim();
        let address = register_form.elements['address'].value.trim();
        let profile = register_form.elements['profile'].files[0];
        let pincode = register_form.elements['pincode'].value.trim();
        let dob = register_form.elements['dob'].value.trim();

        // Check if any required field is missing
        if (!name || !email || !phone || !password || !cpassword || !address || !profile || !pincode || !dob) {
            showToast('danger', 'All fields are required!');
            return;
        }

        let formData = new FormData();
        formData.append('name', name);
        formData.append('email', email);
        formData.append('phone', phone);
        formData.append('password', password);
        formData.append('cpassword', cpassword);
        formData.append('address', address);
        formData.append('profile', profile);
        formData.append('pincode', pincode);
        formData.append('dob', dob);
        formData.append('register', true);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/login_register.php', true);

        // Set up a listener for the response
        xhr.onload = function() {
            if (this.status == 200) {
                try {
                    // Attempt to parse the response as JSON
                    let response = JSON.parse(this.responseText);

                    // If the parsing is successful, handle the response
                    if (response.status == 'success') {
                        showToast('success', response.message);
                        register_form.reset();
                        // Close the modal after successful registration
                        bootstrap.Modal.getInstance(document.getElementById('registerModal')).hide();
                    } else {
                        showToast('danger', response.message);
                    }
                } catch (e) {
                    showToast('danger', "An error occurred. Please try again.");
                }
            }
        }
        
        // Set up a listener for network errors
        xhr.onerror = function() {
            showToast('danger', "An error occurred. Please try again.");
        };
        
        xhr.send(formData);
    });

    let login_form = document.getElementById('login-form');

    login_form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Collect form values
        let email = login_form.elements['email_mob'].value.trim();
        let password = login_form.elements['password'].value.trim();

        // Check if any required field is missing
        if (!email || !password) {
            showToast('danger', 'All fields are required!');
            return;
        }

        let formData = new FormData();
        formData.append('email', email);
        formData.append('password', password);
        formData.append('login', true);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/login_register.php', true);
        xhr.onload = function() {
            if (this.status == 200) {
                try {
                    // Attempt to parse the response as JSON
                    let response = JSON.parse(this.responseText);

                    // If the parsing is successful, handle the response
                    if (response.status == 'success') {
                        showToast('success', response.message);
                        setTimeout(() => {
                            window.location.href = window.location.href.split('?')[0];
                        }, 1000);
                    } else {
                        showToast('danger', response.message);
                    }
                } catch (e) {
                    showToast('danger', "An error occurred. Please try again.");
                }
            }
        }
        xhr.send(formData);
    });

    let forgot_form = document.getElementById('forgot-form');

    forgot_form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Collect form values
        let email = forgot_form.elements['email'].value.trim();

        // Check if any required field is missing
        if (!email) {
            showToast('danger', 'All fields are required!');
            return;
        }

        let formData = new FormData();
        formData.append('email', email);
        formData.append('forgot', true);

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/login_register.php', true);

        // Set up a listener for the response
        xhr.onload = function() {
            if (this.status == 200) {
                try {
                    // Attempt to parse the response as JSON
                    let response = JSON.parse(this.responseText);

                    // If the parsing is successful, handle the response
                    if (response.status == 'success') {
                        showToast('success', response.message);
                        forgot_form.reset();
                        // Close the modal after successful password reset request
                        bootstrap.Modal.getInstance(document.getElementById('forgotModal')).hide();
                    } else {
                        showToast('danger', response.message);
                    }
                } catch (e) {
                    showToast('danger', "An error occurred. Please try again.");
                }
            }
        }

        // Set up a listener for network errors
        xhr.onerror = function() {
            showToast('danger', "An error occurred. Please try again.");
        };

        xhr.send(formData);
    });

    setActive();
</script>

<footer class="container-fluid bg-white mt-5">
    <div class="row col-lg-12">
        <div class="col-lg-3 p-4">
            <h3 class="h-font fw-bold fs-3 mb-2">
                <?php echo $settings_r['site_title'] ?>
            </h3>
            <p>
                <?php echo $settings_r['site_about'] ?>
            </p>
        </div>
        <div class="col-lg-3 p-4">
            <h5 class="mb-3">Links</h5>
            <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">
                Home
            </a><br>
            <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">
                Rooms
            </a><br>
            <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">
                Facilities
            </a><br>
            <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">
                Contact Us
            </a><br>
            <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">
                About
            </a>
        </div>
        <div class="col-lg-3 p-4">
            <h5 class="mb-3">Follow Us</h5>
            <a href="<?php echo $contact_r['facebook'] ?>" target="_blank"
                class="d-inline-block mb-2 text-dark text-decoration-none">
                <i class="bi bi-facebook"></i>
                Facebook
            </a><br>
            <a href="<?php echo $contact_r['twitter'] ?>" target="_blank"
                class="d-inline-block mb-2 text-dark text-decoration-none">
                <i class="bi bi-twitter"></i>
                Twitter
            </a><br>
            <a href="<?php echo $contact_r['instagram'] ?>" target="_blank"
                class="d-inline-block mb-2 text-dark text-decoration-none">
                <i class="bi bi-instagram"></i>
                Instagram
            </a><br>
            <a href="<?php echo $contact_r['linkedin'] ?>" target="_blank"
                class="d-inline-block mb-2 text-dark text-decoration-none">
                <i class="bi bi-linkedin"></i>
                Linkedin
            </a><br>
            <a href="<?php echo $contact_r['youtube'] ?>" target="_blank"
                class="d-inline-block mb-2 text-dark text-decoration-none">
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