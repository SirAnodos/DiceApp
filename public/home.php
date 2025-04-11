<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../styles/style.css">
  <meta charset="UTF-8">
  <title>DiceApp | Home</title>
</head>
<body>

<?php $loggedIn = false; $userName = "user.name"; ?> <!-- This is just to test! Will check for session token. -->

<!-- Navigation Bar -->
<ul class="nav-bar">
  <!-- Pages -->
  <li class="active-page"> <a href="home.php">HOME</a> </li>
  <li> <a href="roller.php">ROLLER</a> </li>
  <li> <a href="statistics.php">STATISTICS</a> </li>
  <li> <a href="help.php">HELP</a> </li>
  <!-- Dropdown for account login, logout, create -->
  <li class="nav-right" id="acct-dropdn-btn" onClick="hideShowDropdown('acct-dropdn-btn', 'acct-dropdn')">
    <span id="uname-nav"><?php
      if ($loggedIn) {
        echo $userName;
      } else {
        echo "Login";
      }?>
    </span>
  </li>
</ul>

<div class="dropdn acct-dropdn" id="acct-dropdn">
  <?php
  if ($loggedIn) {
    echo "
      <button id='logout-btn'>Logout</button>
      <button id='delete-btn'>Delete Account</button>";
  } else {
    echo "
      <span>Username:</span>
      <input type='text' id='uname-input' autocomplete='off'>
      <span>Password:</span>
      <input type='text' id='pwd-input' autocomplete='off'><br>
      <button id='login-btn'>Login</button>
      <button id='register-btn'>Register</button>
      <span id='login-status-msg'></span>";
  }
  ?>
</div>

<div class="content-wrapper"> <!-- container for main content -->
<div class="content"> <!-- visible content div -->

  <h2 class="page-title"> DiceApp Home </h2>
  <p>
    DiceApp is a free web-based dice roller for tabletop games. It also contains
    functionality for viewing statistics of dice configurations.
  </p>
  <ul>
    <li style="list-style-type:none">development notes:</li>
    <li>Make distribution histogram for statistics page.</li>
    <li>Make the whole site less fugly.</li>
    <li>Should have been using CSS flexbox this whole time. Read up on that.</li>
    <li>Scalable dice graphics. But that might increase load times.</li>
    <li>Save/import dice configurations and roll history?</li>
  </ul>

</div>
</div>

<!-- footer -->
<ul class="footer">
  <li>
    Gabriel Walker
    <?php echo " " . date("Y"); ?>
  </li>
  <li>Background Image by
    <a href="https://unsplash.com/@dan_horgan?utm_content=creditCopyText&
    utm_medium=referral&utm_source=unsplash">Dan Horgan</a> on
    <a href="https://unsplash.com/photos/background-pattern-gMU6nVaU8Tk?utm_
    content=creditCopyText&utm_medium=referral&utm_source=unsplash">Unsplash</a>
  </li>
</ul>

<script src="../scripts/dropdowns.js"></script>
<script src="../scripts/account.js"></script>

</body>
</html>
