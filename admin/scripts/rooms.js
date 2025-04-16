let add_room_form = document.getElementById('add_room_form');
let edit_room_form = document.getElementById('edit_room_form');
let add_image_form = document.getElementById('add_image_form');

function edit_room() {
    let room_id = edit_room_form.elements['room_id']?.value;
    let room_name = edit_room_form.elements['room_name']?.value;
    let room_area = edit_room_form.elements['room_area']?.value;
    let room_price = edit_room_form.elements['room_price']?.value;
    let room_quantity = edit_room_form.elements['room_quantity']?.value;
    let room_adult = edit_room_form.elements['room_adult']?.value;
    let room_children = edit_room_form.elements['room_children']?.value;
    let room_description = edit_room_form['room_description']?.value;

    let features = [];
    edit_room_form.elements['features'].forEach(el => {
        if (el.checked) {
            features.push(el.value);
        }
    });

    let facilities = [];
    edit_room_form.elements['facilities'].forEach(el => {
        if (el.checked) {
            facilities.push(el.value);
        }
    });

    // Validate name and picture presence
    if (
        room_name.trim() === '' ||
        room_area.trim() === '' ||
        room_price.trim() === '' ||
        room_quantity.trim() === '' ||
        room_adult.trim() === '' ||
        room_children.trim() === '' ||
        room_description.trim() === ''
    ) {
        showToast('danger', 'All fields are required!');
        return;
    }

    let formData = new FormData();
    formData.append('room_id', room_id);
    formData.append('room_name', room_name);
    formData.append('room_area', room_area);
    formData.append('room_price', room_price);
    formData.append('room_quantity', room_quantity);
    formData.append('room_adult', room_adult);
    formData.append('room_children', room_children);
    formData.append('room_description', room_description);
    formData.append('room_features', JSON.stringify(features));
    formData.append('room_facilities', JSON.stringify(facilities));
    formData.append('edit_room', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById("edit-room");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let response = this.responseText.trim();

        if (response === '1') {
            showToast('success', "Room Edited!");
            edit_room_form.reset();
            get_rooms();
        } else {
            showToast('danger', "Server Down!");
        }
    };

    xhr.send(formData);
}

function get_rooms() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('room-data').innerHTML = this.responseText;
    }

    xhr.send('get_rooms');
}

function edit_details(id) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        data = JSON.parse(this.responseText);
        edit_room_form.elements['room_name'].value = data.roomdata.name;
        edit_room_form.elements['room_area'].value = data.roomdata.area;
        edit_room_form.elements['room_price'].value = data.roomdata.price;
        edit_room_form.elements['room_quantity'].value = data.roomdata.quantity;
        edit_room_form.elements['room_adult'].value = data.roomdata.adult;
        edit_room_form.elements['room_children'].value = data.roomdata.children;
        edit_room_form.elements['room_description'].value = data.roomdata.description;
        edit_room_form.elements['room_id'].value = data.roomdata.sl_no;
        edit_room_form.elements['features'].forEach(el => {
            if (data.features.includes(parseInt(el.value))) {
                el.checked = true;
            } else {
                el.checked = false;
            }
        });
        edit_room_form.elements['facilities'].forEach(el => {
            if (data.facilities.includes(parseInt(el.value))) {
                el.checked = true;
            } else {
                el.checked = false;
            }
        });
    };

    xhr.send('get_room=' + id);
}

function add_room() {
    let room_name = add_room_form.elements['room_name']?.value;
    let room_area = add_room_form.elements['room_area']?.value;
    let room_price = add_room_form.elements['room_price']?.value;
    let room_quantity = add_room_form.elements['room_quantity']?.value;
    let room_adult = add_room_form.elements['room_adult']?.value;
    let room_children = add_room_form.elements['room_children']?.value;
    let room_description = add_room_form['room_description']?.value;

    let features = [];
    add_room_form.elements['features'].forEach(el => {
        if (el.checked) {
            features.push(el.value);
        }
    });

    let facilities = [];
    add_room_form.elements['facilities'].forEach(el => {
        if (el.checked) {
            facilities.push(el.value);
        }
    });

    // Validate name and picture presence
    if (
        room_name.trim() === '' ||
        room_area.trim() === '' ||
        room_price.trim() === '' ||
        room_quantity.trim() === '' ||
        room_adult.trim() === '' ||
        room_children.trim() === '' ||
        room_description.trim() === ''
    ) {
        showToast('danger', 'All fields are required!');
        return;
    }

    let formData = new FormData();
    formData.append('room_name', room_name);
    formData.append('room_area', room_area);
    formData.append('room_price', room_price);
    formData.append('room_quantity', room_quantity);
    formData.append('room_adult', room_adult);
    formData.append('room_children', room_children);
    formData.append('room_description', room_description);
    formData.append('room_features', JSON.stringify(features));
    formData.append('room_facilities', JSON.stringify(facilities));
    formData.append('add_room', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById("add-room");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let response = this.responseText.trim();

        if (response === '1') {
            showToast('success', "New Room Added!");
            add_room_form.reset();
            get_rooms();
        } else {
            showToast('danger', "Server Down!");
        }
    };

    xhr.send(formData);
}

function toggle_status(id, val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        let response = this.responseText.trim();
        if (response === '1') {
            showToast('success', "Status Toggled!");
            get_rooms();
        } else {
            showToast('danger', "Server Down!");
        }
    }

    xhr.send('toggle_status=' + id + '&value=' + val);
}

function add_image() {
    let room_id = add_image_form.elements['room_id']?.value;
    let image = add_image_form.elements['image']?.files[0];
    // Validate name and picture presence
    if (!image) {
        showToast('danger', 'Please select an image!');
        return;
    }

    // Validate file type
    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    if (!allowedTypes.includes(image.type)) {
        showToast('danger', 'Invalid image type. Allowed types: JPG, PNG, WEBP.');
        return;
    }

    // Validate file size (limit: 2MB)
    const maxSizeMB = 2;
    if (image.size / (1024 * 1024) > maxSizeMB) {
        showToast('danger', 'Image size must be less than 2MB.');
        return;
    }

    let formData = new FormData();
    formData.append('room_id', room_id);
    formData.append('image', image);
    formData.append('add_image', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);

    xhr.onload = function () {
        let response = this.responseText.trim();
        if (response === '1') {
            showToast('success', "Image Added!");
            room_images(room_id, document.querySelector('#room-images .modal-title').innerText);
            add_image_form.reset();
        } else if (response === 'inv_img') {
            showToast('error', "Invalid image format!");
        } else if (response === 'inv_size') {
            showToast('error', "Image size should be less than 2MB!");
        } else if (response === 'upd_failed') {
            showToast('error', "Image upload failed. Please try again!");
        } else {
            showToast('danger', "Server Down!");
        }
    };

    xhr.send(formData);
}

function room_images(id, name) {
    document.querySelector('#room-images .modal-title').innerText = name;
    add_image_form.elements['room_id'].value = id;
    add_image_form.reset();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('room-image-data').innerHTML = this.responseText;
    }

    xhr.send('get_room_images=' + id);
}

function delete_image(img_id, room_id) {
    let data = new FormData();
    data.append('image_id', img_id);
    data.append('room_id', room_id);
    data.append('delete_image', '');


    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);

    xhr.onload = function () {
        let response = this.responseText.trim();
        if (response === '1') {
            showToast('success', "Image Deleted!");
            room_images(room_id, document.querySelector('#room-images .modal-title').innerText);
        } else {
            showToast('danger', "Server Down!");
        }
    }

    xhr.send(data);
}

function thumb_image(img_id, room_id) {
    let data = new FormData();
    data.append('image_id', img_id);
    data.append('room_id', room_id);
    data.append('thumb_image', '');


    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);

    xhr.onload = function () {
        let response = this.responseText.trim();
        if (response === '1') {
            showToast('success', "Thumbnail Set!");
            room_images(room_id, document.querySelector('#room-images .modal-title').innerText);
        } else {
            showToast('danger', "Server Down!");
        }
    }

    xhr.send(data);
}

function rem_thumb(img_id, room_id) {
    let data = new FormData();
    data.append('image_id', img_id);
    data.append('room_id', room_id);
    data.append('rem_thumb', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);

    xhr.onload = function () {
        let response = this.responseText.trim();
        if (response === '1') {
            showToast('success', "Thumbnail Removed!");
            room_images(room_id, document.querySelector('#room-images .modal-title').innerText);
        } else {
            showToast('danger', "Failed to remove thumbnail.");
        }
    };

    xhr.send(data);
}

function delete_room(id) {
    if (!confirm("Are you sure you want to delete this room?")) {
        return;
    }
    let data = new FormData();
    data.append('room_id', id);
    data.append('delete_room', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/rooms_crud.php", true);

    xhr.onload = function () {
        let response = this.responseText.trim();
        if (response === '1') {
            showToast('success', "Room Deleted!");
            get_rooms();
        } else {
            showToast('danger', "Server Down!");
        }
    }

    xhr.send(data);
}

window.onload = function () {
    get_rooms();
}