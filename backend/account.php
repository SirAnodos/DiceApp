<?php
$uname = $_POST['uname'] ?? null;
$pwd = $_POST['pwd'] ?? null;
$action = $_POST['action'];
include('db-connect.php');

if ($action == 'login') {
    $qry = $connection->prepare("SELECT id, password FROM users WHERE username = ?");
    $qry->bind_param('s', $uname);
    $qry->execute();
    $qry->store_result();

    if ($qry->num_rows === 1) {
        $qry->bind_result($id, $pwdHash);
        $qry->fetch();

        if (password_verify($pwd, $pwdHash)) {
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['uname'] = $uname;
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
    $qry = $connection->prepare("SELECT id FROM users WHERE username = ?");
    $qry->bind_param('s', $uname);
    $qry->execute();
    $qry->store_result();

    if ($qry->num_rows === 0) {
        $qry = $connection->prepare("INSERT INTO `users` (`id`, `username`, `password`) VALUES (NULL, '?', '?')");
        $qry->bind_param('ss', $uname, password_hash($pwd));
        $qry->execute();
        $id = $connection->insert_id;
        header('HTTP/1.1 200');
        session_start();
        $_SESSION['id'] = $id;
        $_SESSION['uname'] = $uname;
    } else {
        header('HTTP/1.1 409');
    }
}
?>