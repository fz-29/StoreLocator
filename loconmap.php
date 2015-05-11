<?php
	require_once("includes/connection.php");
	require_once("includes/h_functions.php");
	require_once("includes/map_functions.php");
	//FETCHING THE GET VARIABLES
	if(isset($_GET['lat'])&&isset($_GET['lng'])&&isset($_GET['name'])&&isset($_GET['add']))
	{
		$lat=$_GET['lat'];
		$lng=$_GET['lng'];
		$storename=$_GET['name'];
		$address=$_GET['add'];
	}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" href="css/map.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/header.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css">
		<title>Welcome to theDataBugs</title>

		<?php echo scriptformap();//JAVA SCRIPT FOR GOOGLE API AND MAP ?>
		
	</head>
	<body onload="initialize()">
		<div id="headerContainer" >
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
		<div class="container">
			<div id="ask" style="position: absolute; top: 5px;
			        left: 40%;
			        margin-left: -180px;
			        z-index: 5;
			        background-color: #ffffff;
			        padding: 5px;
			        border: 1px solid #999;">
				<?php $lurl="mediate.php?lat=".urlencode($lat)."&lng=".urlencode($lng)."&name=".urlencode($storename)."&add=".urlencode($address);?>
				<a href="<?php echo $lurl.'&opt=1' ;?>" target="_self"><button>Click to get directions from YOUR CURRENT position</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo $lurl.'&opt=2' ;?>" target="_self"><button>Click to get directions from custom position</button></a>
			</div>
			<div id="map-canvas" >
			</div>
			
		</div>		
	</body>
</html>