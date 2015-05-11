<?php
	require_once("includes/connection.php");
	require_once("includes/search_functions.php");
?>
<?php
$bool=isset($_GET['searchKey']);
	if(isset($_GET['searchKey']))
	{
		$KEY=$_GET['searchKey'];
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/page.css">
		<title>Search Page</title>
	</head>
	<body>
	<div class="pageContainer" >
		<div class="searchContainer">
			<?php
				echo searchbox();
			?>
		</div>
		<div id="myresults">
			<?php
				echo query_fetch_tabulate();
			?>
		</div>		
	</div>
	</body>
</html>