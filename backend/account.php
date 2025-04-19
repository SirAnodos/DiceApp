<?php
$uname = $_POST['uname'] ?? null;
$pwd = $_POST['pwd'] ?? null;
$action = $_POST['action'];
include(db-connect.php);

if ($action == 'login') {
    $qry = $connection->prepare('SELECT id, password FROM users WHERE username = ?');
    $qry->bind_param('s', $uname);
    $qry->execute();
    $qry->store_result();

    if ($qry->num_rows === 1) {
        $qry->bind_result($userID, $pwdHash);
        $qry->fetch();

        if (password_verify($pwd, $pwdHash)) {
            session_start();
            $_SESSION['user_id'] = $userID;
            $_SESSION['username'] = $uname;

            header('HTTP/1.1 200');
        } else {
            header('HTTP/1.1 401');
        }
    } else {
        header('HTTP/1.1 401');
    }
} else

if ($action == 'logout') {
    header('HTTP/1.1 200');
} else

if ($action == 'register') {
    header('HTTP/1.1 200');
}
?>