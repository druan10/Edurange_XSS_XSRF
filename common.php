<?php
session_start();
echo "<!--Created by David Ruan (2016)-->";
#Needed for Demonstration Purposes, do not change this value
header("X-XSS-Protection: 1; mode=block");

function redirect($url){
  header("Location: ".$url); /* Redirect browser */
  exit();
}

function checkLoggedIn(){
  /*If function is called with no arguments, will return "loggedin" status
  If a url is passed to the function, will redirect to that page if user is logged in
  */
  if (func_num_args()==0){
    if (isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]==true&&$_SESSION["username"]!=""){
      return true;
    } else{
      return false;
    }
  }else{
    if (isset($_SESSION["loggedin"])&&$_SESSION["loggedin"]==true&&$_SESSION["username"]!=""){
      redirect(func_get_arg(0));
    } 
  }
}

// Generate div with appropriate error message
function throwMessage(){
  if (isset($_SESSION["error"])){
        echo "<div class='alert alert-danger'>
              <strong>Error! </strong>".$_SESSION["error"]."
              </div>";
        unset($_SESSION["error"]);}
  if (isset($_SESSION["info"])){
        echo "<div class='alert alert-info'>
              <strong>Info: </strong>".$_SESSION["info"]."
              </div>";
        unset($_SESSION["info"]);}
  if (isset($_SESSION["success"])){
        echo "<div class='alert alert-success'>
              <strong>Info: </strong>".$_SESSION["success"]."
              </div>";
        unset($_SESSION["success"]);
  }
}

// Clear message variables
function clearMessages(){
  unset($_SESSION["error"]);
  unset($_SESSION["info"]);
  unset($_SESSION["success"]);
}

// Show posts ordered from latest > oldest
function fetchPosts($user){
  $files = glob("./profiles/".$user."/*.txt");
  $posts = [];
  foreach ($files as $i){
    if (preg_match("/\.\/profiles\/".$user."\/".$user."\-\d{2}\-\d{2}\-\d{4}\-\d{2}\-\d{2}\-\d{2}.txt/",$i)) {
         array_push($posts, $i);
     }
  } 
  //Get array in order from latest to oldest
  $posts = array_reverse($posts);
  return $posts;
}

#test\-\d{2}\-\d{2}\-\d{4}\-\d{2}\-\d{2}\-\d{2}(\.txt)
function generateNavbar(){
  ?>
  <!--Left side of Navbar-->
  <nav class='navbar navbar-default'>
    <div class='container-fluid'>
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class='navbar-header'>
        <button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1' aria-expanded='false'>
          <span class='sr-only'>Toggle navigation</span>
          <span class='icon-bar'></span>
          <span class='icon-bar'></span>
          <span class='icon-bar'></span>
        </button>
        <a class='navbar-brand' href='./index.php'>EduRange</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
    <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
    <?php
    #NewPost link, if logged in
    if (isset($_SESSION['username'])){
    ?>
    <ul class='nav navbar-nav'>
      <li><a href='./writepost.php'>New Post</a></li>
    </ul>
    <?php
    }
    ?>
    <!--Right Side of Navbar-->
    <ul class='nav navbar-nav navbar-right'>
      <li class='dropdown'>
        <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'> Me <span class='caret'></span></a>
        <ul class='dropdown-menu'>
          <?php
          if (!isset($_SESSION['username'])){
          ?>
            <li><a href='./login.php'>Sign in</a></li>
            <li><a href='#'>About This Site</a></li>
          <?php
          }else{
          ?>
            <li><a href='./user_profile.php?username=<?=$_SESSION["username"]?>'>My Profile</a></li>
            <li><a href='./logout.php'>Sign Out</a></li>
            <li><a href='#'>About This Site</a></li>
          <?php
          }
          ?>
        </ul>
      </li>
    </ul>
      <form class='navbar-form navbar-right' role='search'>
        <div class='form-group'>
          <input type='text' class='form-control' placeholder='Search Users'>
        </div>
        <button type='submit' class='btn btn-default'>Submit</button>
      </form>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <?php
}

function generateFeed(){
  print("Uh oh! You're not following anyone!");
}

function searchUsers($query){
  
}

function fetchUserPhoto($user){
  
}


?>

