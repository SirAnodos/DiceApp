document.getElementById('login-btn').addEventListener('click', function() {
    console.log('clicked');
    const uname = document.getElementById('uname-input').value;
    const pwd = document.getElementById('pwd-input').value;
    const loginXHR = new XMLHttpRequest();

    loginXHR.open('POST', '../backend/account.php')
    loginXHR.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    loginXHR.onload = function() {
        if (loginXHR.status == 401) {
            document.getElementById('login-status-msg').innerHTML = "Incorrect username or password!";
        } else if (loginXHR.status == 200) {
            document.getElementById('uname-nav').innerHTML = uname;
            document.getElementById('acct-dropdn').innerHTML = "" +
              "<button id='logout-btn'>Logout</button>" +
              "<button id='delete-btn'>DeleteAccount</button>";
        }
    }

    const data = 'action=login&uname=${uname}&pwd=${pwd}';
    loginXHR.send(data);
})