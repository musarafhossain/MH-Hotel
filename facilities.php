<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MH Hotel - Facilities</title>
    <!-- Common Links -->
    <?php require_once('./include/links.php'); ?>
    <style>
        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s ease;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <?php require_once('./include/header.php'); ?>

    <!--Heading-->
    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">OUR FACILITIES</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3 mx-auto" style="max-width: 700px;">
            <?php echo $settings_r['site_about'] ?>
        </p>
    </div>
    
    <!--Facilities Section-->
    <div class="container">
        <div class="row">
            <?php
                $res = selectAll('facilities');
                $path = FACILITIES_IMG_PATH;

                while ($row = mysqli_fetch_assoc($res)) {
                    echo<<<data
                        <div class="col-lg-4 col-md-6 mb-5 px-4">
                            <div class="bg-white rounded shadow p-4 border-top border-4 border-dark pop">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="$path$row[icon]" width="50px" alt="Room" class="me-3">
                                    <h5 class="m-0">$row[name]</h5>
                                </div>
                                <p>$row[description]</p>
                            </div>
                        </div>
                    data;
                }
            ?>
        </div>
    </div>

    <!--Footer-->
    <?php require_once('./include/footer.php'); ?>

    <!--Include Common Scripts-->
    <?php require_once('./include/scripts.php'); ?>
</body>

</html>