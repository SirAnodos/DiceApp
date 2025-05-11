<?php
session_start();

// Navigation Bar
echo "
<ul class='nav-bar'>
  <!-- Pages -->
  <li class=".($activePage=="home" ? "active-page" : "")."> <a href='home.php'>HOME</a> </li>
  <li class=".($activePage=="roller" ? "active-page" : "")."> <a href='roller.php'>ROLLER</a> </li>
  <li class=".($activePage=="statistics" ? "active-page" : "")."> <a href='statistics.php'>STATISTICS</a> </li>
  <li class=".($activePage=="help" ? "active-page" : "")."> <a href='help.php'>HELP</a> </li>
  <!-- Dropdown for account login, logout, create -->
  <li class='nav-right' id='acct-dropdn-btn' onClick='hideShowDropdown(\"acct-dropdn-btn\", \"acct-dropdn\")'>
    <span id='uname-nav'>";
      // if logged in, display username
      if (isset($_SESSION['uname'])) {
        echo $_SESSION['uname'];
      } else {
        echo "Login";
      }
echo "
    </span>
  </li>
</ul>";

// account dropdown menu for login/logout
echo "
<div class='dropdn acct-dropdn' id='acct-dropdn'>";
  // menu options if logged in
  if (isset($_SESSION['uname'])) {
    echo "
      <button id='logout-btn'>Logout</button>
      <button id='delete-btn'>Delete Account</button><br>
      <span id='status-msg' class='status-msg'></span>";
  // menu options if logged out
  } else {
    echo "
      <span>Username:</span>
      <input type='text' id='uname-input' autocomplete='off'>
      <span>Password:</span>
      <input type='text' id='pwd-input' autocomplete='off'><br>
      <button id='login-btn'>Login</button>
      <button id='register-btn'>Register</button><br>
      <span id='status-msg' class='status-msg'></span>";
  }
echo "
</div>";
?>