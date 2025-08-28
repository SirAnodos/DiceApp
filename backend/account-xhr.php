<?php
// start session, get data from $_POST, connect to database
session_start();
$uname = $_POST['uname'] ?? ;
$pwd = $_POST['pwd'] ?? '';
$action = $_POST['action'] ?? null;

include("account-handler.inc.php");

$accountHandler = new AccountHandler($uname, $pwd);

if ($action == 'login') {list($hrc, $msg) = $accountHandler->login();} else
if ($action == 'logout') {list($hrc, $msg) = $accountHandler->logout();} else
if ($action == 'register') {list($hrc, $msg) = $accountHandler->register();} else
if ($action == 'delete') {list($hrc, $msg) = $accountHandler->delete();} else
if (is_null($action)) {list($hrc, $msg) = $accountHandler->nullAction();}

http_response_code($hrc);
echo $msg;

?>