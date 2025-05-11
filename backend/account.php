<?php
// start session, get data from $_POST, connect to database
session_start();
$uname = $_POST['uname'] ?? null;
$pwd = $_POST['pwd'] ?? null;
$action = $_POST['action'] ?? null;
include('db-connect.php');

// end if no action code
if (is_null($action)) {
    http_response_code(200);
} else

// login account
if ($action == 'login') {
    // db query: get user
    $qry = $connection->prepare("SELECT id, password FROM users WHERE username = ?");
    $qry->bind_param('s', $uname);
    $qry->execute();
    $qry->store_result();

    // if user exists, try to validate
    if ($qry->num_rows === 1) {
        $qry->bind_result($id, $pwdHash);
        $qry->fetch();

        // verify password, echo proper response for success or failure
        if (password_verify($pwd, $pwdHash)) {
            // set session variables if successful
            $_SESSION['id'] = $id;
            $_SESSION['uname'] = $uname;
            http_response_code(200);
            echo "Login successful.";
        } else {
            http_response_code(401);
            echo "Password incorrect.";
        }
    // user does not exist
    } else {
        http_response_code(401);
        echo "Invalid username.";
    }
} else

// logout account
if ($action == 'logout') {
    // unset session variables
    session_unset();
    http_response_code(200);
    echo "Logged out.";
} else

// register account
if ($action == 'register') {
    // check for valid username and password
    if ($uname == '' || $uname == null) {
        http_response_code(422);
        echo "Username required.";
    } else if ($pwd == '' || $pwd == null) {
        http_response_code(422);
        echo "Password required.";
    // if username and password are valid, try to register account
    } else {
        // hash password for storage
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        // db query: get user to check if username is available
        $qry = $connection->prepare("SELECT id FROM users WHERE username = ?");
        $qry->bind_param('s', $uname);
        $qry->execute();
        $qry->store_result();

        // if username is available, register new user
        if ($qry->num_rows === 0) {
            // db query: insert new user
            $qry = $connection->prepare("INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, ?, ?)");
            $qry->bind_param('ss', $uname, $hashedPwd);
            $qry->execute();
            // set session variables
            $id = $connection->insert_id;
            $_SESSION['id'] = $id;
            $_SESSION['uname'] = $uname;
            http_response_code(200);
            echo "Registration successful.";
        // username not available
        } else {
            http_response_code(409);
            echo "Username unavailable.";
        }
    }
} else

// delete account
if ($action == 'delete') {
    // db query: delete user by id
    $qry = $connection->prepare("DELETE FROM users WHERE id = ?");
    $qry->bind_param('s', $_SESSION['id']);
    $qry->execute();
    session_unset();
    http_response_code(200);
    echo "Account deleted.";
}
?>