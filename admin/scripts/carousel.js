function add_image() {
    let carousel_picture = document.getElementById('carousel_picture_input').files[0];

    // Validate name and picture presence
    if (!carousel_picture) {
        showToast('danger', 'All fields are required!');
        return;
    }

    // Validate file type
    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    if (!allowedTypes.includes(carousel_picture.type)) {
        showToast('danger', 'Invalid image type. Allowed types: JPG, PNG, WEBP.');
        return;
    }

    // Validate file size (limit: 2MB)
    const maxSizeMB = 2;
    if (carousel_picture.size / (1024 * 1024) > maxSizeMB) {
        showToast('danger', 'Image size must be less than 2MB.');
        return;
    }

    let formData = new FormData();
    formData.append('picture', carousel_picture);
    formData.append('add_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById("carousel-s");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let response = this.responseText.trim();

        if (response === '1') {
            showToast('success', "New Image Added!");
            reset_carousel_form();
            get_carousel();
        } else if (response === 'inv_img') {
            showToast('error', "Invalid image format!");
        } else if (response === 'inv_size') {
            showToast('error', "Image size should be less than 2MB!");
        } else if (response === 'upd_failed') {
            showToast('error', "Image upload failed. Please try again!");
        } else {
            showToast('warning', "No Changes Made!");
        }
    };

    xhr.send(formData);
}

function get_carousel() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('carousel-data').innerHTML = this.responseText;
    }

    xhr.send('get_carousel');
}

function delete_image(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/carousel_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText === '1') {
            showToast('success', "Image Removed!");
            get_carousel();
        } else {
            showToast('danger', "Server Down!");
        }
    }

    xhr.send('delete_image=' + val);
}

function reset_carousel_form() {
    let carousel_picture = document.getElementById('carousel_picture_input');

    // Reset the file input
    if (carousel_picture) carousel_picture.value = '';
}

window.onload = function () {
    get_carousel();
}