<?php
include 'common.php';

#Check for login $_POST variables
if (!isset($_SESSION["loggedin"])){
  if (isset($_POST["loginorsignup"])){
    if ($_POST["loginorsignup"]=="signup"){
      if (file_exists("./database/db.txt")){
        if (!userExists($_POST["username"])){
          if ($_POST["pwd"]==$_POST["pwd2"]){
            $db = fopen("./database/db.txt", "a");
            $user = (string) $_POST["username"];
            $hash = (string) password_hash($_POST["pwd"], PASSWORD_DEFAULT);
            $userinfo = $user . ";" . $hash . ";\n";
            fwrite($db,$userinfo);
            fclose($db);
            $_SESSION["loggedin"]=true;
            $_SESSION["username"]=$user;
            redirect("./user_home.php");
          }else{
            $_SESSION["error"]="Passwords did not match";
          }
        }else{
          $_SESSION["error"]="Username is Taken";
        }
      }else{
        $db = fopen("./database/db.txt", "w");
        fclose($db);
        if ($_POST["pwd"]==$_POST["pwd2"]){
          $db = fopen("./database/db.txt", "a");
            $user = (string) $_POST["username"];
            $hash = (string) password_hash($_POST["pwd"], PASSWORD_DEFAULT);
            $userinfo = $user . ";" . $hash . ";\n";
            fwrite($db,$userinfo);
            fclose($db);
            $_SESSION["loggedin"]=true;
            $_SESSION["username"]=$user;
            redirect("./user_home.php");
        }
      }
    }else{
      checkCredentials();
    }
  }
}else{
  redirect("./user_home.php");
}

function userExists($user){
  $exists = false;
  $db = file("./database/db.txt");
    for ($i=0;$i<count($db);$i++){
      $line = explode(";",$db[$i]);
      if ($line[0]==$user){
        $exists=true;
      }
  }
  return $exists;
}

function checkCredentials(){
  $db = file("./database/db.txt");
    for ($i=0;$i<count($db);$i++){
      $line = explode(";",$db[$i]);
      if ($line[0]==$_POST["username"]){
        if (password_verify($_POST["pwd"], $line[1])){
          $_SESSION["loggedin"]=true;
          $_SESSION["username"]=$_POST["username"];
          redirect("./user_home.php");
        }
      }
    }
  $_SESSION["error"]="Username or Password is incorrect. Try Again!";
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
    <link rel="stylesheet" type="text/css" href="./css/style_simple.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  </head>
  <body>
    <?php generateNavbar();?>
    <br>
    <h1 class="text-center">Login/Sign up</h1>
    <!--Display Errors-->
    <div class="container">
      <?php
      if (isset($_SESSION["error"])){
        echo "<div class='alert alert-danger'>
              <strong>Error! </strong>".$_SESSION["error"]."
              </div>";
        unset($_SESSION["error"]);}?>
    </div>
      
    <!--Login/Sign up Form-->
  	<div class="container loginform">
  		<div class="well">
			<h2>Login</h2>
			<form role="form" action="./login.php" method="post">
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="text" class="form-control" name="username" placeholder="Enter Username">
				</div>
				<div class="form-group">
					<label for="pwd">Password:</label>
					<input type="password" class="form-control" name="pwd" placeholder="Enter password">
				</div>
				<div class="checkbox">
					<label><input type="checkbox" name="checkbox"> Remember me</label>
				</div>
        <input type="hidden" name="loginorsignup" value="login">
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
  		</div>
	</div>

  <div class="container signupform">
      <div class="well">
      <h2>Sign up</h2>
      <form role="form" action="./login.php" method="post">
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" class="form-control" name="username" placeholder="Enter Username">
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input type="password" class="form-control" name="pwd" placeholder="Enter password">
        </div>
        <div class="form-group">
          <label for="pwd">Confirm your Password:</label>
          <input type="password" class="form-control" name="pwd2" placeholder="Retype your password">
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="checkbox"> Remember me</label>
        </div>
        <input type="hidden" name="loginorsignup" value="signup">
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
      </div>
  </div>

    <!--Google JQuery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>


