document.getElementById('acct-dropdn').addEventListener('click', function(event) {
    const target = event.target.id;
    if (target === 'login-btn' || target === 'register-btn' || target === 'logout-btn') {
        let uname, pwd, data;
        if (target === 'login-btn' || target === 'register-btn') {
            uname = document.getElementById('uname-input').value;
            pwd = document.getElementById('pwd-input').value;
        }

        const XHR = new XMLHttpRequest();
        XHR.open('POST', '../backend/account.php')
        XHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        XHR.onload = function() {
            if (XHR.status == 401) {
                document.getElementById('login-status-msg').innerHTML = "Incorrect username or password!";
            } else if (XHR.status == 200) {
                if (target === 'login-btn' || target === 'register-btn') {
                    document.getElementById('uname-nav').innerHTML = uname;
                    document.getElementById('acct-dropdn').innerHTML = "" +
                    "<button id='logout-btn'>Logout</button>" +
                    "<button id='delete-btn'>DeleteAccount</button>";
                } else if (target === 'logout-btn') {
                    document.getElementById('uname-nav').innerHTML = "login";
                    document.getElementById('acct-dropdn').innerHTML = "" +
                    "<span>Username:</span>" +
                    "<input type='text' id='uname-input' autocomplete='off'>" +
                    "<span>Password:</span>" +
                    "<input type='text' id='pwd-input' autocomplete='off'><br>" +
                    "<button id='login-btn'>Login</button>" +
                    "<button id='register-btn'>Register</button>" +
                    "<span id='login-status-msg'></span>";
                }
            }
        }

        if (target === 'login-btn') {
            data = 'action=login&uname=${uname}&pwd=${pwd}';
        } else if (target === 'register-btn') {
            data = 'action=register&uname=${uname}&pwd=${pwd}';
        } else if (target === 'logout-btn') {
            data = 'action=logout';
        }
        XHR.send(data);
    }
})
