let feature_s_form = document.getElementById('feature_s_form');
let facility_s_form = document.getElementById('facility_s_form');

function add_feature() {

    // Validate name and picture presence
    if (feature_s_form.elements['feature_name'].value.trim() === '') {
        showToast('danger', 'All fields are required!');
        return;
    }

    let formData = new FormData();
    formData.append('feature_name', feature_s_form.elements['feature_name'].value);
    formData.append('add_feature', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById("feature-s");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let response = this.responseText.trim();

        if (response === '1') {
            showToast('success', "New Feature Added!");
            feature_s_form.elements['feature_name'].value = "";
            get_features();
        } else {
            showToast('danger', "Server Down!");
        }
    };

    xhr.send(formData);
}

function get_features() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('features-data').innerHTML = this.responseText;
    }

    xhr.send('get_features');
}

function delete_feature(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText === '1') {
            showToast('success', "Feature Removed!");
            get_features();
        } else if (this.responseText === 'room_added') {
            showToast('danger', "Feature is added in room!");
        } else {
            showToast('danger', "Server Down!");
        }
    }

    xhr.send('delete_feature=' + val);
}

function add_facility() {
    let facility_name = facility_s_form.elements['facility_name']?.value;
    let facility_icon = facility_s_form['facility_icon']?.files[0];
    let facility_description = facility_s_form['facility_description']?.value;

    // Validate name and picture presence
    if (facility_name.trim() === '' || facility_description.trim() === '' || !facility_icon) {
        showToast('danger', 'All fields are required!');
        return;
    }

    // Validate file type
    const allowedTypes = ['image/svg+xml'];
    if (!allowedTypes.includes(facility_icon.type)) {
        showToast('danger', 'Invalid image type. Allowed types: SVG.');
        return;
    }

    // Validate file size (limit: 1MB)
    const maxSizeMB = 1;
    if (facility_icon.size / (1024 * 1024) > maxSizeMB) {
        showToast('danger', 'Image size must be less than 1MB.');
        return;
    }

    let formData = new FormData();
    formData.append('facility_name', facility_name);
    formData.append('facility_icon', facility_icon);
    formData.append('facility_description', facility_description);
    formData.append('add_facility', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById("facility-s");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let response = this.responseText.trim();

        if (response === '1') {
            showToast('success', "Facility Added!");
            facility_s_form.reset();
            get_facilities();
        } else if (response === 'inv_img') {
            showToast('danger', "Invalid image format!");
        } else if (response === 'inv_size') {
            showToast('danger', "Image size should be less than 2MB!");
        } else if (response === 'upd_failed') {
            showToast('danger', "Image upload failed. Please try again!");
        } else {
            showToast('danger', "Server Down!");
        }
    };

    xhr.send(formData);
}

function get_facilities() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('facilities-data').innerHTML = this.responseText;
    }

    xhr.send('get_facilities');
}

function delete_facility(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText === '1') {
            showToast('success', "Facility Removed!");
            get_facilities();
        } else if (this.responseText === 'room_added') {
            showToast('danger', "Facility is added in room!");
        } else {
            showToast('danger', "Server Down!");
        }
    }

    xhr.send('delete_facility=' + val);
}

window.onload = function () {
    get_features();
    get_facilities();
}