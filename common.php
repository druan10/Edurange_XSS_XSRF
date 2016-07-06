<!-- Organize based on use -->
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

function setupAccount(){
  #Setup Account Profile
  mkdir("./profiles/".$_SESSION["username"]);
  $profile=fopen("./profiles/".$_SESSION["username"]."/".$_SESSION["username"].".txt","w");
  fwrite($profile,date("m-d-Y").PHP_EOL);
  fclose($profile);
}

function checkSignup(){
  // Check for signup post variables
  if (isset($_POST["username"])&&$_POST["username"]!=""&&isset($_POST["pwd"])){
    // Check password requirements before continuing
    // Requires 2 separate regular expression matches and a password length test
    preg_match("/[A-Z]/", $_POST["pwd"],$capital);
    preg_match("/\d/", $_POST["pwd"],$num);
    if (count($capital)>0 && count($num)>0 && strlen($_POST["pwd"])>=8){
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
            setupAccount();
            $_SESSION["info"]="Successfully Created account!";
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
            setupAccount();
            redirect("./user_home.php");
        }
      }
    }
  }else{
    $_SESSION["Error"]="An error occurred. Please try again!";
  }
}

function checkLogin(){
  #Check for login $_POST variables
  if (isset($_POST["username"])&&$_POST["username"]!=""&&isset($_POST["pwd"])){
    #LOGIN
    checkCredentials();
  }else{
    $_SESSION["Error"]="An error occurred. Please try again!";
  }
}

function showLatestPost(){
  #show last post, if it was succesfully posted
  if (isset($_SESSION["posted"])&&($_SESSION["posted"]==true)){
    $latestPost=file_get_contents(fetchUserPosts($_SESSION["username"])[0]);
    ?>
      <div class = 'container blogpost'>
        <h2 class='text-center'>Your latest post</h2><?=$latestPost?>
      </div>
    <?php
    unset($_SESSION["posted"]);
  }
}

function writePost(){
  // Check for blog post submission in POST variables
  // Save post as txt file
  if (isset($_POST["newpost"])&&$_POST["newpost"]!=""){
    // Make sure post isn't too long
    if (strlen($_POST["newpost"])<=500){
      // Sanitize html and save to a variable
      $blogpost = sanitizeHtml($_POST["newpost"]);
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
}

function sanitizeHtml($postText){
  // Basic HTML sanitizer
  // Blocked tags and attributes
  $tagBlacklist = ['script'];
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

function generateUserContent(){
  // Reset user posts array to make sure posts are for the correct user
  if (isset($userData)){
    unset($userData);
  }

  // Fetch user posts  and assign them to the user posts array
  $userData=fetchUserPosts($_GET["username"]);
  // Generate user content
  // If longer than 1, user has written posts
  if (count($userData)>1){
    ?>
      <br>
      <h2 class="text-center" style="text-decoration: underline;"><?=$_GET["username"]?>'s Latest Posts</h2>
      <br>
    <?php
    // Generate divs for each user post, not including user data
    foreach (array_slice($userData,1) as $i){
      $posttext=file_get_contents($i);
      ?>
        <div class='container blogpost'>
          <table>
            <tr>
              <td>
                <?=$posttext?>
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

// Show posts ordered from latest > oldest
function fetchUserPosts($user){
  $userFile = glob("./profiles/".$user."/*.txt");
  $data = [];
  foreach ($userFile as $i){
    if (preg_match("/\.\/profiles\/".$user."\/".$user."\-\d{2}\-\d{2}\-\d{4}\-\d{2}\-\d{2}\-\d{2}.txt/",$i)) {
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

function fetchCreationDate($user){
 return file("./profiles/".$user."/".$user.".txt")[0];
}

?>

