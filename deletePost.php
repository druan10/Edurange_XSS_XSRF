<?php
include 'common.php';
	if (isset($_POST["index"]) && isset($_SESSION["username"])){ // Logged in and index is set
		$user=$_SESSION["username"];
		// Delete a user's post based on the index sent in the ajax request
		// $userData=fetchUserData($_SESSION["username"]);
		$userFiles = glob("./profiles/".$user."/*.txt");
		$data = [];
		foreach ($userFiles as $i){
		if (preg_match("/\.\/profiles\/".$user."\/".$user."\-\d{2}\-\d{2}\-\d{4}\s\d{2}\-\d{2}(am|pm)\d{2}\.txt/",$i)) {
		     array_push($data, $i);
		 }
		}
		unlink($data[$_POST["index"]]);
		echo "deleted post" ;
	}else{
		echo "error";
	}
?>