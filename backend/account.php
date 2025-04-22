<?php
session_start();
$uname = $_POST['uname'] ?? null;
$pwd = $_POST['pwd'] ?? null;
$action = $_POST['action'];
include('db-connect.php');
echo isset($_SESSION) ? 'true' : 'false';

if ($action == 'login') {
    $qry = $connection->prepare("SELECT id, password FROM users WHERE username = ?");
    $qry->bind_param('s', $uname);
    $qry->execute();
    $qry->store_result();

    if ($qry->num_rows === 1) {
        $qry->bind_result($id, $pwdHash);
        $qry->fetch();

        if (password_verify($pwd, $pwdHash)) {
            $_SESSION['id'] = $id;
            $_SESSION['uname'] = $uname;
            http_response_code(200);
            echo "Login successful.";
        } else {
            http_response_code(401);
            echo "Password incorrect.";
        }
    } else {
        http_response_code(401);
        echo "Invalid username.";
    }
} else

if ($action == 'logout') {
    setcookie(session_name(), '', time() - 42000);
    session_unset();
    session_destroy();
    http_response_code(200);
    echo "Logged out.";
} else

if ($action == 'register') {
    if ($pwd == '' || $pwd == null) {
        http_response_code(422);
        echo "Password required.";
    } else {
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
        $qry = $connection->prepare("SELECT id FROM users WHERE username = ?");
        $qry->bind_param('s', $uname);
        $qry->execute();
        $qry->store_result();

        if ($qry->num_rows === 0) {
            $qry = $connection->prepare("INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, ?, ?)");
            $qry->bind_param('ss', $uname, $hashedPwd);
            $qry->execute();
            $id = $connection->insert_id;
            $_SESSION['id'] = $id;
            $_SESSION['uname'] = $uname;
            http_response_code(200);
            echo "Registration successful.";
        } else {
            http_response_code(409);
            echo "Username unavailable.";
        }
    }
}
?>