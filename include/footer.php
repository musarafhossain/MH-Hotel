<!-- Manage Nav Links Active -->
<script>
  function setActive(){
    let navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for (let i = 0; i < a_tags.length; i++) {
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if(document.location.href.indexOf(file_name) >= 0){
        a_tags[i].classList.add('active');
      }
    }
  }

  setActive();
</script>

<footer class="container-fluid bg-white mt-5">
    <div class="row col-lg-12">
        <div class="col-lg-3 p-4">
            <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $settings_r['site_title'] ?></h3>
            <p><?php echo $settings_r['site_about'] ?></p>
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
            <a href="<?php echo $contact_r['facebook'] ?>" target="_blank" class="d-inline-block mb-2 text-dark text-decoration-none">
                <i class="bi bi-facebook"></i>
                Facebook
            </a><br>
            <a href="<?php echo $contact_r['twitter'] ?>" target="_blank" class="d-inline-block mb-2 text-dark text-decoration-none">
                <i class="bi bi-twitter"></i>
                Twitter
            </a><br>
            <a href="<?php echo $contact_r['instagram'] ?>" target="_blank" class="d-inline-block mb-2 text-dark text-decoration-none">
                <i class="bi bi-instagram"></i>
                Instagram
            </a><br>
            <a href="<?php echo $contact_r['linkedin'] ?>" target="_blank" class="d-inline-block mb-2 text-dark text-decoration-none">
                <i class="bi bi-linkedin"></i>
                Linkedin
            </a><br>
            <a href="<?php echo $contact_r['youtube'] ?>" target="_blank" class="d-inline-block mb-2 text-dark text-decoration-none">
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