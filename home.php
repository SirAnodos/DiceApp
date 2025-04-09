<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
  <meta charset="UTF-8">
  <title>DiceApp | Home</title>
</head>
<body>

<!-- Navigation Bar -->
<ul class="nav-bar">
  <li class="active-page"> <a href="home.php">HOME</a> </li>
  <li> <a href="roller.php">ROLLER</a> </li>
  <li> <a href="statistics.php">STATISTICS</a> </li>
  <li> <a href="help.php">HELP</a> </li>
</ul>

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

</body>
</html>
