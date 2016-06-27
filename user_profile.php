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

    <div class="container-fluid profile-page">
      <div class="row">
        <?php 
        throwMessage();
        ?>
        <!-- Sidebar -->
        <div class="col-md-2 profile-sidebar visible-lg">
          <img src="./img/default_avatar.gif">
          <ul>
            <li>Thing 1</li>
            <li>Thing 2</li>
            <li>Thing 3</li>
            <li>Thing 4</li>
          </ul>
        </div>
        <!-- Main Content -->
        <div class="col-md-10 profile-content">
          <!-- Fetch User Posts -->
          <?php
            // Reset user posts array to ensure posts belong to the appropriate user
            if (isset($posts)){
              unset($posts);
            }
            // Fetch user posts and assign them to the user posts array
            $posts=fetchPosts($_GET["username"]);
            if (count($posts)>0){
              ?>
                <br>
                <h2 class="text-center" style="text-decoration: underline;"><?=$_GET["username"]?>'s Latest Posts</h2>
                <br>
              <?php
              // Generate divs for each user post
              foreach ($posts as $i){
                $posttext=file_get_contents($i);
                ?>
                  <div class='container blogpost'>
                    <?=$posttext?>
                  </div>
                <?php
              }
            }else{
              ?>
                <div class='container blogpost'>
                  <h2>You have no posts!</h2>
                </div>
              <?php
            }

          ?>
        </div>
      </div>
    </div>
    
    <!--Google JQuery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>