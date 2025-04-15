<div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top">
    <h3 class="mb-0 h-font">MH HOTEL</h3>
    <a href="logout.php" class="btn btn-danger btn-sm">LOGOUT</a>
</div>

<div class="col-lg-2 container-fluid bg-dark border-top border-3 border-secondary" id="dashboard-menu">
    <nav id="admin-nav-bar" class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid flex-lg-column d-flex">
            <h4 class="mt-3 text-light">ADMIN PANEL</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#adminDropdown" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="bi bi-filter fs-1"></i>
            </button>
            <div style="width: 100%;" class="collapse navbar-collapse flex-column align-items-stretch mt-2"
                id="adminDropdown">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-items">
                        <a href="dashboard.php" class="nav-link text-white">Dashboard</a>
                    </li>
                    <li class="nav-items">
                        <a href="rooms.php" class="nav-link text-white">Rooms</a>
                    </li>
                    <li class="nav-items">
                        <a href="users.php" class="nav-link text-white">Users</a>
                    </li>
                    <li class="nav-items">
                        <a href="features_facilities.php" class="nav-link text-white">Features & Facilities</a>
                    </li>
                    <li class="nav-items">
                        <a href="user_queries.php" class="nav-link text-white">User Queries</a>
                    </li>
                    <li class="nav-items">
                        <a href="carousel.php" class="nav-link text-white">Carousel</a>
                    </li>
                    <li class="nav-items">
                        <a href="settings.php" class="nav-link text-white">Settings</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</div>

<script>
    //Manage Link Active
    function setActive() {
        let navbar = document.getElementById('admin-nav-bar');
        let a_tags = navbar.getElementsByTagName('a');

        for (let i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if (document.location.href.indexOf(file_name) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }

    setActive();
</script>
