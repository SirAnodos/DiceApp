<?php
// start session, get data from $_POST
session_start();
$profile = $_POST['profile'] ?? '';
$roll = $_POST['roll'] ?? '';
$rollData = $_POST['roll-data'] ?? '';
$action = $_POST['action'] ?? null;

// create ProfilesHandler object
include('profiles-handler.inc.php');
$profilesHandler = new ProfilesHandler()

// perform the action given by $_POST
if ($action == 'load') {list($hrc, $msg) = $profilesHandler->load();} else
if ($action == 'add-profile') {list($hrc, $msg) = $profilesHandler->addProfile();} else
if ($action == 'delete-profile') {list($hrc, $msg) = $profilesHandler->deleteProfile();} else
if ($action == 'add-roll') {list($hrc, $msg) = $profilesHandler->addRoll();} else
if ($action == 'delete-roll') {list($hrc, $msg) = $profilesHandler->deleteRoll();} 
else {list($hrc, $msg) = array(200, '');}

// return responce code and status message
http_response_code($hrc);
echo $msg;

?>