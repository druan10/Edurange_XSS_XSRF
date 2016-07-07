<?php

// General

session_start();
echo "<!--Created by David Ruan (2016)-->";
// Browser Cross Site Scripting Prevention
header("X-XSS-Protection: 1; mode=block");

// Page Redirection

function redirect($url){
  header("Location: ".$url); /* Redirect browser */
  exit();
}

// Helper Message Management

function clearMessages(){ // Manually remove all error messages
  unset($_SESSION["error"]);
  unset($_SESSION["info"]);
  unset($_SESSION["success"]);
}

function throwMessage(){ // Generates error messages
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

// Authentication & Validation

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

function userExists($user){ // Read's database file and checks if username exists
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

function setupAccount(){ // Creates a directory and profile information text file for user on signup
  mkdir("./profiles/".$_SESSION["username"]);
  $profile=fopen("./profiles/".$_SESSION["username"]."/".$_SESSION["username"].".txt","w");
  fwrite($profile,date("m-d-Y").PHP_EOL);
  fclose($profile);
}

function checkSignup(){
  if (isset($_POST["username"])&&$_POST["username"]!=""&&isset($_POST["pwd"])){ // Check that required signup post variables exist
    // Validate username and password requirement using regular expressions
    preg_match("/[A-Z]/", $_POST["pwd"],$capital);
    preg_match("/\d/", $_POST["pwd"],$num);
    preg_match("/^[a-zA-Z0-9\_]{4,10}$/",$_POST["username"],$usernameReq);
    if (count($capital)>0 && count($num)>0 && count($usernameReq)>0 && strlen($_POST["pwd"])>=8){ // If regex tests are passed
      if (!userExists($_POST["username"])){ // If username isn't taken, continue
        if ($_POST["pwd"]==$_POST["pwd2"]){ // Check if submitted passwords's match
          $db = fopen("./database/db.txt", "a");
          $user = (string) $_POST["username"];
          $hash = (string) password_hash($_POST["pwd"], PASSWORD_DEFAULT);
          $userinfo = $user . ";" . $hash . ";\n";
          fwrite($db,$userinfo);
          fclose($db);
          $_SESSION["username"]=$_POST["username"];
          setupAccount();
          $_SESSION["info"]="Successfully Created account!";
          redirect("./user_home.php");
        }else{
          $_SESSION["error"]="Passwords did not match";
        }
      }else{
        $_SESSION["error"]="Username is Taken";
      }
    }
  }else{
    $_SESSION["Error"]="An error occurred. Please try again!";
  }
}

function checkLogin(){
  if (isset($_POST["username"])&&$_POST["username"]!=""&&isset($_POST["pwd"])){ // Check that required login post variables exist
    $db = file("./database/db.txt");
    for ($i=0;$i<count($db);$i++){ // Check whether username exists in database file
      $line = explode(";",$db[$i]);
      if ($line[0]==$_POST["username"]){
        if (password_verify($_POST["pwd"], $line[1])){ 
          $_SESSION["loggedin"]=true;
          $_SESSION["username"]=$_POST["username"];
          redirect("./user_home.php");
        }else{
          $_SESSION["Error"]="An error occurred. Please try again!";
        }
      }
    }
    $_SESSION["error"]="Username or Password is incorrect. Try Again!";
  }else{
    $_SESSION["Error"]="An error occurred. Please try again!";
  }
}

function sanitizeHtml($postText){ // Basic HTML sanitation system
  // Blocked tags
  $tagBlacklist = ['script'];
  // Blocked html attributes
  $attributeBlacklist = ['onblur', 'onchange', 'onclick', 'ondblclick', 'onfocus',
    'onkeydown', 'onkeypress', 'onkeyup', 'onload', 'onmousedown',
    'onmousemove', 'onmouseout','onmouseup',
    'onreset','onselect', 'onsubmit', 'onunload'];
  // blocked tags as visible html
  $blockedStart=htmlentities("<blocked>");
  $blockedEnd=htmlentities("</blocked>");
  // If blocked tag is found, replace it with <blocked> tag. Uses case insensitive string replace function
  foreach ($tagBlacklist as $i){
    $postText = str_ireplace ("<".$i.">",$blockedStart, $postText);
    $postText = str_ireplace ("</".$i.">",$blockedEnd, $postText);
  }
  // If blocked attribute is found IN THIS FORMAT, remove it.
  foreach ($attributeBlacklist as $i){
    $postText = str_ireplace ($i."=","blocked=", $postText);
  }
  return $postText;
}

// HTML content generation

// Generates Navigation Bar
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
    // Add link to write a new post if user is logged in
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
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <?php
}

function generateFeed(){ // Deprecated (BUT STILL USED BECAUSE I'M AN EXCELLENT CODER :D)
  print("Uh oh! You're not following anyone!");
}

function showLatestPost(){ // Show user's latest post if it was submitted successfully
  if (isset($_SESSION["posted"])&&($_SESSION["posted"]==true)){
    
    ?>
      <div class = 'container blogpost'>
        <h2 class='text-center'>Your latest post</h2>
        <?php echo end(fetchUserData($_SESSION["username"])["posts"]) ?>
      </div>
    <?php
    unset($_SESSION["posted"]);
  }
}

function fetchUserData($user){ //Gather user data and add it to specially formatted array (Assumes user exists)
  $userData=array(
    "username" => $user,
    "creationDate" => file("./profiles/".$user."/".$user.".txt")[0],
    "bio" => "placeholder text",
    "posts" => array(
      )
    );
  // Add key value pairs for each post the user has made to the posts array inside the userData structure
  $userFiles = glob("./profiles/".$user."/*.txt");
  foreach ($userFiles as $i){
    if (preg_match("/\.\/profiles\/".$user."\/".$user."\-\d{2}\-\d{2}\-\d{4}\s\d{2}\-\d{2}(am|pm)\.txt/",$i)) {
         $userData["posts"][] = array(substr($i,-22,18),file_get_contents($i));
     }
  } 
  return $userData;
}

function generateUserContent(){ // Display's user's posts on their profile
  if (count($GLOBALS["userData"]["posts"])>0){ // Check if user has any posts
    ?>
      <br>
      <h2 class="text-center" style="text-decoration: underline;"><?=$GLOBALS["userData"]["username"]?>'s Posts</h2>
      <br>
    <?php
    // Generate divs for each user post, not including user data
    foreach ($GLOBALS["userData"]["posts"] as $i){
      ?>
        <div class='container blogpost'>
          <?php
            // Allow user to delete posts if it's their account
            if ($_SESSION["username"]==$_GET["username"]){
              ?>
            <p style="text-decoration:underline"><?=$i[0]?>
              <a class="deletePost" href="#" style="float:right;color:red">
                <i class="fa fa-times" aria-hidden="true"></i>
              </a>
            </p>
              <?php
            }
          ?>
          <table>
            <tr>
              <td>
                <!--User Post-->
                <?=$i[1]?>
              </td>
            </tr>
          </table>
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
}

function fetchUserPosts($user){ // Gathers user's posts from the text files in their profile folder
  $userFile = glob("./profiles/".$user."/*.txt");
  $data = [];
  foreach ($userFile as $i){
    if (preg_match("/\.\/profiles\/".$user."\/".$user."\-\d{2}\-\d{2}\-\d{4}\s\d{2}\-\d{2}(am|pm)\.txt/",$i)) {
         array_push($data, $i);
     }
  } 
  // Get array in order from latest to oldest
  $data = array_reverse($data);
  // Add user information to the front of the array
  // Add Account Creation date to front of array
  array_unshift($data, $userFile[0]);
  return $data;
}

function writePost(){
  if (isset($_POST["newpost"])&&$_POST["newpost"]!=""){
    // Make sure post isn't too long
    if (strlen($_POST["newpost"])<=500){
      // Sanitize html and save to a variable
      $blogpost = sanitizeHtml($_POST["newpost"]);
      // Write santized html to file
      $post = fopen("./profiles/".$_SESSION["username"]."/".$_SESSION["username"]."-".date("m-d-Y h-ia").".txt","a");
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
}

?>

