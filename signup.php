<?php
include 'common.php';
checkLoggedin("./user_home.php");
checkSignup();
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
    <link rel="stylesheet" type="text/css" href="./css/style_simple.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  </head>
  <body>
    <?php generateNavbar();?>
    <br>
    <h1 class="text-center">Sign up</h1>
    <!--Display Errors-->
    <div class="container">
      <?php
      throwMessage();
      ?>
    </div>
  <div class="container signupform">
      <div class="well">
      <h2>Sign up</h2>
      <form role="form" action="./signup.php" method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <p id="usernameHelper">Only letters, numbers, & underscores. (Max length 10) <i class="fa fa-times" id="usernameReq" aria-hidden="true"></i></p>
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" maxlength="10" required>
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" id="pwd" name="pwd" maxlength="20" placeholder="Enter password" required>
        </div>
        <div class="form-group">
          <label for="pwd">Confirm your Password:</label>
          <input type="password" class="form-control" id="pwd2" name="pwd2" maxlength="20" placeholder="Retype your password" required>
        </div>
        <button type="submit" id="signupSubmit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
  <div class="container">
    <div id="pswd_info">
      <h4>Password must meet the following requirements:</h4>
      <ul>
          <li><i class="fa fa-times" id="capital" aria-hidden="true"></i> At least <strong>one capital letter</strong></li>
          <li><i class="fa fa-times" id="number" aria-hidden="true"></i> At least <strong>one number</strong></li>
          <li><i class="fa fa-times" id="length" aria-hidden="true"></i> At least <strong>8 characters long</strong> (MAX 20 Characters)</li>
      </ul>
    </div>
  </div>
  <div class="container text-center">
    <h3>Back to Login page</h3>
    <button type="button" class="btn btn-primary" id="logmein">Back</button>
  </div>
    <!--Google JQuery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="./checkRequirements.js"></script>
  </body>
</html>