<?php
$uname = $_POST['uname'];
$pwd = $_POST['pwd'];
$action = $_POST['action'];

if ($action == 'login') {
    header('HTTP/1.1 200');
}

?>