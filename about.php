<?php
include 'common.php';
clearMessages();
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
    <?php generateNavbar();?>
  	<div class="container main text-center">
  		<h1>
  			About this Site!
  		</h1>
  		<p>
  			EDURange Social is a vulnerable web application. This site is modeled off of Google's "Gruyere" website.

        Running on EDURange, you should have access to the site's server which you can ssh into.
        Once there, ls to /var/www/html to find the site's source files. 
        You have full read/write access to the files. If you can't figure out how to break the website, look at the code itself.
  		</p>
  		<h3>
  			Tasks:
  		</h3>
  		<ul>
  			<li>Sign up and try to inject a script into a blog post.</li>
  			<li>Log in and check out user notahacker's profile. What is this profile doing?
  			<a href="./user_profile.php?username=notahacker">notahacker's profile.</a></li>
  			<li>Why wasn't this script caught by the html sanitizer? Fix it!</li>
  		</ul>
  	</div>
    <!--Google JQuery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  </body>
</html>