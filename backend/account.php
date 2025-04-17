<?php
$uname = $_POST['uname'] ?? null;
$pwd = $_POST['pwd'] ?? null;
$action = $_POST['action'];

if ($action == 'login') {
    header('HTTP/1.1 200');
}

if ($action == 'logout') {
    header('HTTP/1.1 200');
}

?>