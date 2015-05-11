<?php
	require_once("includes/connection.php");
	require_once("includes/h_functions.php");
?>

<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" href="css/myindex.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/header.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css">
		<title>Welcome to theDataBugs
		</title>
		<base target="iframePage"/>
	</head>
	<body>
		<div id="headerContainer">
		<?php// imported from iframe_header ?>
			<div class="siteHeadDiv">
				<?php	
				echo header_top();
				?>
			</div>
			<div class="nav">
				<?php
					echo header_nav();
				?>
			</div>		
		</div>
		<div id="pageFrame">
			<iframe  name="iframePage" style="min-height:768px; width:100%;" seamless="seamless" src="iframe_page.php"></iframe>
		
		<div class="footer">
				<ul>
				<li><a href="" >Home</a></li>
				<li><a href="" target="iframePage">About Us</a></li>
				<li><a href="" target="iframePage">Contact Us</a></li>
				</ul>
		</div>
		</div>		
		
	</body>
</html>