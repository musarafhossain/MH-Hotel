let general_data, contacts_data;

function get_general() {
    let site_title = document.getElementById('site_title');
    let site_about = document.getElementById('site_about');
    let site_title_input = document.getElementById('site_title_input');
    let site_about_input = document.getElementById('site_about_input');

    let shutdown_toggle = document.getElementById("shutdown_toggle");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        general_data = JSON.parse(this.responseText);

        site_title.innerText = general_data.site_title;
        site_about.innerText = general_data.site_about;

        site_title_input.value = general_data.site_title;
        site_about_input.value = general_data.site_about;

        if (general_data.shutdown == 0) {
            shutdown_toggle.checked = false;
            shutdown_toggle.value = 0;
        } else {
            shutdown_toggle.checked = true;
            shutdown_toggle.value = 1;
        }
    }

    xhr.send('get_general');
}

function update_general() {
    let site_title_value = document.getElementById('site_title_input').value.trim();
    let site_about_value = document.getElementById('site_about_input').value.trim();

    // Check if any field is empty
    if (site_title_value === '' || site_about_value === '') {
        showToast('danger', 'All fields are required!');
        return;
    }

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        var myModal = document.getElementById("general-s");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            showToast('success', "Changes Saved!");
            get_general();
        } else {
            showToast('warning', "No Changes Made!");
        }
    }

    xhr.send('site_title=' + site_title_value + '&site_about=' + site_about_value + '&update_general');
}

function reset_general_form() {
    document.getElementById('site_title_input').value = general_data.site_title;
    document.getElementById('site_about_input').value = general_data.site_about;
}

function update_shutdown(value) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {

        if (this.responseText == 1 && general_data.shutdown == 0) {
            showToast('success', "Site has been shutdown!");
        } else {
            showToast('success', "Shutdown mode off!");
        }
        get_general();
    }

    xhr.send('update_shutdown=' + value);
}

function get_contacts() {
    let contacts_p_id = ['address', 'gmap', 'phone', 'email', 'facebook', 'instagram', 'twitter', 'linkedin', 'youtube'];
    let iframe = document.getElementById('iframe');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        contacts_data = JSON.parse(this.responseText);
        contacts_data = Object.values(contacts_data);

        for (let i = 0; i < contacts_p_id.length; i++) {
            document.getElementById(contacts_p_id[i]).innerText = contacts_data[i + 1];
        }
        iframe.src = contacts_data[10];
        reset_contacts_form();
    }

    xhr.send('get_contacts');
}

function update_contacts() {
    const contacts_p_id = ['address', 'gmap', 'phone', 'email', 'facebook', 'instagram', 'twitter', 'linkedin', 'youtube', 'iframe'];
    const contacts_input_id = ['address_input', 'gmap_input', 'phone_input', 'email_input', 'facebook_input', 'instagram_input', 'twitter_input', 'linkedin_input', 'youtube_input', 'iframe_input'];

    const data = new URLSearchParams();

    // Validate each contact input
    for (let i = 0; i < contacts_input_id.length; i++) {
        const inputElement = document.getElementById(contacts_input_id[i]);
        const value = inputElement?.value.trim() || "";

        if (value === "") {
            showToast('danger', `All fields are required!`);
            inputElement?.focus();
            return;
        }

        data.append(contacts_p_id[i], value);
    }

    data.append("update_contacts", "1");

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        const myModal = document.getElementById("contact-s");
        const modal = bootstrap.Modal.getInstance(myModal);
        modal?.hide();

        if (this.responseText.trim() === "1") {
            showToast('success', "Changes Saved!");
            get_contacts();
        } else {
            showToast('warning', "No Changes Made!");
        }
    };

    xhr.send(data.toString());
}

function reset_contacts_form() {
    let contacts_input_id = ['address_input', 'gmap_input', 'phone_input', 'email_input', 'facebook_input', 'instagram_input', 'twitter_input', 'linkedin_input', 'youtube_input'];
    let iframe_input = document.getElementById('iframe_input');

    for (let i = 0; i < contacts_input_id.length; i++) {
        document.getElementById(contacts_input_id[i]).value = contacts_data[i + 1];
    }
    iframe_input.value = contacts_data[10];
}

function add_member() {
    let member_name = document.getElementById('member_name_input').value.trim();
    let member_picture = document.getElementById('member_picture_input').files[0];

    // Validate name and picture presence
    if (member_name === '' || !member_picture) {
        showToast('danger', 'All fields are required!');
        return;
    }

    // Validate file type
    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    if (!allowedTypes.includes(member_picture.type)) {
        showToast('danger', 'Invalid image type. Allowed types: JPG, PNG, WEBP.');
        return;
    }

    // Validate file size (limit: 2MB)
    const maxSizeMB = 2;
    if (member_picture.size / (1024 * 1024) > maxSizeMB) {
        showToast('danger', 'Image size must be less than 2MB.');
        return;
    }

    let formData = new FormData();
    formData.append('member_name', member_name);
    formData.append('member_picture', member_picture);
    formData.append('add_member', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);

    xhr.onload = function () {
        var myModal = document.getElementById("team-s");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let response = this.responseText.trim();

        if (response === '1') {
            showToast('success', "Member Added!");
            reset_member_form();
            get_members();
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

function get_members() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('team-data').innerHTML = this.responseText;
    }

    xhr.send('get_members');
}

function delete_member(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        if (this.responseText === '1') {
            showToast('success', "Member Removed!");
            get_members();
        } else {
            showToast('danger', "Server Down!");
        }
    }

    xhr.send('delete_member=' + val);
}

function reset_member_form() {
    let member_name = document.getElementById('member_name_input');
    let member_picture = document.getElementById('member_picture_input');

    // Reset the text input value
    if (member_name) member_name.value = '';

    // Reset the file input
    if (member_picture) member_picture.value = '';
}

window.onload = function () {
    get_general();
    get_contacts();
    get_members();
}