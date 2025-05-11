// handle form submission for login/logout/register/delete
document.getElementById('acct-dropdn').addEventListener('click', function(event) {
    const target = event.target.id;
    if (target.slice(-4) == '-btn') {
        let uname, pwd, data;
        // get data for login or register
        if (target == 'login-btn' || target == 'register-btn') {
            uname = document.getElementById('uname-input').value;
            pwd = document.getElementById('pwd-input').value;
        // get data for logout or delete
        } else {
            uname = document.getElementById('uname-nav').innerHTML;
        }

        // open XHR for account actions
        const XHR = new XMLHttpRequest();
        XHR.open('POST', '../backend/account.php')
        XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        XHR.onload = function() {
            // if action was successful, change account menu
            if (XHR.status == 200) {
                // change menu to logged in
                if (target == 'login-btn' || target == 'register-btn' || target == 'delete-cancel-btn') {
                    document.getElementById('uname-nav').innerHTML = uname;
                    document.getElementById('acct-dropdn').innerHTML = "" +
                    "<button id='logout-btn'>Logout</button>" +
                    "<button id='delete-btn'>Delete Account</button><br>" +
                    "<span id='status-msg' class='status-msg'></span>";
                    document.getElementById('saved-select-div').hidden = false;
                // change menu to logged out
                } else if (target == 'logout-btn' || target == 'delete-confirm-btn') {
                    document.getElementById('uname-nav').innerHTML = "Login";
                    document.getElementById('acct-dropdn').innerHTML = "" +
                    "<span>Username:</span>" +
                    "<input type='text' id='uname-input' autocomplete='off'>" +
                    "<span>Password:</span>" +
                    "<input type='text' id='pwd-input' autocomplete='off'><br>" +
                    "<button id='login-btn'>Login</button>" +
                    "<button id='register-btn'>Register</button><br>" +
                    "<span id='status-msg' class='status-msg'></span>";
                    document.getElementById('saved-select-div').hidden = true;
                // change menu to confirm account deletion
                } else if (target == 'delete-btn') {
                    document.getElementById('acct-dropdn').innerHTML = "" +
                    "<span class='status-msg'>Confirm account deletion?</span><br>" +
                    "<button id='delete-confirm-btn'>Yes</button>" +
                    "<button id='delete-cancel-btn'>No</button><br>" +
                    "<span id='status-msg' class='status-msg'></span>";
                }
            }
            // update status message from PHP
            document.getElementById('status-msg').innerHTML = XHR.responseText;
        }

        // send correct data depending on the button pressed
        if (target == 'login-btn') {
            data = `action=login&uname=${uname}&pwd=${pwd}`;
        } else if (target == 'register-btn') {
            data = `action=register&uname=${uname}&pwd=${pwd}`;
        } else if (target == 'logout-btn') {
            data = `action=logout`;
        } else if (target == 'delete-confirm-btn') {
            data = `action=delete`;
        }
        XHR.send(data);
    }
})
