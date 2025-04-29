function get_users() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('users-data').innerHTML = this.responseText;
    }

    xhr.send('get_users');
}

function toggle_status(id, val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        let response = this.responseText.trim();
        if (response === '1') {
            showToast('success', "Status Toggled!");
            get_users();
        } else {
            showToast('danger', "Server Down!");
        }
    }

    xhr.send('toggle_status=' + id + '&value=' + val);
}

function delete_user(id) {
    if (!confirm("Are you sure you want to delete this user?")) {
        return;
    }
    let data = new FormData();
    data.append('user_id', id);
    data.append('delete_user', '');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);

    xhr.onload = function () {
        let response = this.responseText.trim();
        if (response === '1') {
            showToast('success', "User Deleted!");
            get_users();
        } else {
            showToast('danger', "Server Down!");
        }
    }

    xhr.send(data);
}

function search_user(username) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/users.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function () {
        document.getElementById('users-data').innerHTML = this.responseText;
    }

    xhr.send('search_users=1&name=' + encodeURIComponent(username));
}

window.onload = function () {
    get_users();
}