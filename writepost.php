<?php
include 'common.php';
if (!checkLoggedIn()){
  redirect("./index.php");
}

// Save post as txt file
if (isset($_POST["newpost"])&&$_POST["newpost"]!=""){
    if (strlen($_POST["newpost"])<=500){

      /**
        Basic html sanitizer WIP
      **/
      $_POST["newpost"]=htmlentities($_POST["newpost"]);
      // Blocked tags and attributes
      $blacklist = [
        '<script>','onblur', 'onchange', 'onclick', 'ondblclick', 'onfocus',
        'onkeydown', 'onkeypress', 'onkeyup', 'onload', 'onmousedown',
        'onmousemove', 'onmouseout','onmouseup',
        'onreset','onselect', 'onsubmit', 'onunload'];

      //If blocked tag is found, remove it
      foreach ($blacklist as $i){
        $_POST["newpost"] = str_ireplace ($i, "", $_POST["newpost"]);
      }

      $blogpost = $_POST["newpost"];
      // Write santized html to file
      $post = fopen("./profiles/".$_SESSION["username"]."/".$_SESSION["username"]."-".date("m-d-Y-H-i-s").".txt","a");
      fwrite($post,$blogpost);
      fclose($post);
      $_SESSION["success"]="Your new post was created successfully!";
      $_SESSION["posted"]=true;
      redirect("./user_home.php");
    }else{
      $_SESSION["error"]="An error occurred. Please Try Again!";
      redirect("./user_home.php");
    }
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
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
  </head>
  <body>
    <?php generateNavbar(); ?>
    <br>
    <div class="container main">
      <?php throwMessage(); ?>
      <h1 class="text-center">Write a new post</h1>
      <p>Write a new post for your page!</p>
      <p>(NOTE: Basic html tags are supported! e.g &lt;h1&gt;,&lt;h2&gt;&lt;a&gt;,&lt;strong&gt;,etc...)</p>
      <form role="form" action="./writepost.php" method="post">
        <div class="form-group">
          <label for="post">Post: (limited to 500 characters)</label>
          <textarea class="form-control" rows="5" name="newpost" maxlength="500" required></textarea>
          <button id="postsubmit" type="submit" class="btn btn-default">Submit</button>
        </div>
      </form>
      <br>
      
    </div>
    <!--Google JQuery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>