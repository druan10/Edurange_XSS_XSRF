<?php
session_start();
echo "<!--Created by David Ruan (2016)-->";

function redirect($url){
  header("Location: ".$url); /* Redirect browser */
  exit();
}


function generateNavbar(){
	echo "<nav class='navbar navbar-default'>
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
        <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>";
    #If user is logged in, add option to write new post
	if (isset($_SESSION['username'])){
		echo "<ul class='nav navbar-nav'>
			<li><a href='#'>New Post</a></li>
			</ul>";}

		echo "
			<ul class='nav navbar-nav navbar-right'>
            <!--<li><a href='#'>Link</a></li>-->
            <li class='dropdown'>
              <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'> Me <span class='caret'></span></a>
              <ul class='dropdown-menu'>
              	<!--
              	#Sign out
              	#Account Settings
              	-->";
              	if (!isset($_SESSION['username'])){
                echo "<li><a href='./login.php'>Sign in</a></li>
                <li><a href='#'>About This Site</a></li>";}else{
                	echo "<li><a href='./logout.php'>Sign Out</a></li>
                <li><a href='#'>About This Site</a></li>";}
              echo "</ul>
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
</nav>";
}
?>