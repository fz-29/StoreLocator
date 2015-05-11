<?php
	require_once("includes/connection.php");
	//require_once("includes/functions.php");
	require_once("includes/search_functions.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/page.css">
		<title>The Data Bugs || Helping You...
		</title>
	</head>
	<body>
		<div class="pageContainer" >
			<p id="intro">
			
				Hey, welcome to theDataBugs, you can search your equipment and services and  we'll tell you the most apt place in Delhi for you!! We feel awesome to see you happy!
			</p>

			<div class="searchContainer">
				<?php
					echo searchbox();
				?>
			</div>
		</div>
			
	</body>
</html>