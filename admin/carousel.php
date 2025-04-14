<?php
    require_once('./include/essentials.php');
    adminLogin();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Carousel</title>

    <!-- Common Links -->
    <?php require_once('./include/links.php'); ?>
</head>

<body class="bg-white">
    <!--Include Header-->
    <?php require_once('./include/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-3">CAROUSEL</h3>
                <!-- Carousel Section -->
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Images</h5>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-dark shadow-none btn-sm gap-2 d-flex"
                                data-bs-toggle="modal" data-bs-target="#carousel-s">
                                <i class="bi bi-plus-square"></i>
                                Add
                            </button>
                        </div>
                        <div class="row" id="carousel-data">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Management Modal -->
    <div class="modal fade" id="carousel-s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form>
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Image</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="carousel_picture_input" class="form-label fw-bold">Picture</label>
                            <input type="file" accept=".jpg, .png, .jpeg, .webp" class="form-control shadow-none"
                                id="carousel_picture_input">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn text-secondary shadow-none border" data-bs-dismiss="modal"
                            onclick="reset_carousel_form()">
                            CANCEL
                        </button>
                        <button type="button" class="btn custom-bg text-white shadow-none" onclick="add_image()">
                            ADD
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--Include Common Scripts-->
    <?php require_once('./include/scripts.php'); ?>

    <script src="./scripts/carousel.js"></script>
</body>

</html>