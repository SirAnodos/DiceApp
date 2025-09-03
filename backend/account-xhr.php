<?php
// start session, get data from $_POST
session_start();
$uname = $_POST['uname'] ?? '';
$pwd = $_POST['pwd'] ?? '';
$action = $_POST['action'] ?? null;

// create AccountHandler object
include('account-handler.inc.php');
$accountHandler = new AccountHandler($uname, $pwd);

// perform the action given by $_POST
if ($action == 'login') {list($hrc, $msg) = $accountHandler->login();} else
if ($action == 'logout') {list($hrc, $msg) = $accountHandler->logout();} else
if ($action == 'register') {list($hrc, $msg) = $accountHandler->register();} else
if ($action == 'delete') {list($hrc, $msg) = $accountHandler->delete();}
else {list($hrc, $msg) = array(200, '');}

// return responce code and status message
http_response_code($hrc);
echo $msg;

?>