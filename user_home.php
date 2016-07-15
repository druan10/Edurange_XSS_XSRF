<?php
include 'common.php';
if (!checkLoggedIn()){
  redirect("./index.php");
}
?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>EduRange!</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  </head>
  <body>
    <?php
      generateNavbar();
    ?>

  	<div class="container main">
      <br>
      <?php 
        throwMessage();
      ?>
      <h2 class="text-center">Welcome <?=$_SESSION["username"]?>!</h2>
    </div>
    <br>
    <div class="container main">
      <h1 class="text-center">Quick Links</h1>
      <div class="row text-center">
        <div class="col-sm-4 ">
          <h3>Search for a user profile</h3>
          <br>
          <form action="#" class="home-item">
            <input type="text"></input>
            <input type="submit" value="Search">
          </form>
        </div>
        <div class="col-sm-4 ">
          <h3>View your profile</h3>
          <a href='./user_profile.php?username=<?=$_SESSION["username"]?>'><i class="fa fa-user home-item quick-link fa-5x" aria-hidden="true"></i></a>
          
        </div>
        <div class="col-sm-4 ">
          <h3>Learn more about this site</h3>
          <a href="./about.php"><i class="fa fa-info home-item quick-link fa-5x" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>
    <br>
    <!--Google JQuery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="quicklinks.js"></script>
  </body>
</html>