<?php
	require_once("includes/connection.php");
	require_once("includes/h_functions.php");
	require_once("includes/map_functions.php");
	//FETCHING THE GET VARIABLES
	if(isset($_GET['lat'])&&isset($_GET['lng'])&&isset($_GET['name'])&&isset($_GET['add'])&&isset($_GET['opt']))
	{
		$lat=$_GET['lat'];
		$lng=$_GET['lng'];
		$storename=$_GET['name'];
		$address=$_GET['add'];
		$option=$_GET['opt'];
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Your Way</title>
    	<link rel="stylesheet" href="css/map.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/header.css">
		<link rel="stylesheet" type="text/css" href="css/footer.css">
    <style>
      
      #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
    
    <script>
    var myLat=<?php echo $lat; ?>;
	var myLng=<?php echo $lng; ?>;
	var myAdd='<?php echo $address; ?>';
	var myName='<?php echo $storename; ?>';
	var myOpt=<?php echo $option; ?>;
    </script>

	<script> 
	var destPos=new google.maps.LatLng(myLat,myLng);
	var currPos;  
	var map;
	var directionsDisplay;
	var directionsService;
	var stepDisplay;
	var markerArray = [];

function initialize() {
	
  // Instantiate a directions service.
  directionsService = new google.maps.DirectionsService();

  // Create a map and center it on Delhi.
  var newdelhi = new google.maps.LatLng(28.6139, 77.2089);
  var mapOptions = {
    zoom: 11,
    center: newdelhi
  }
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  // Create a renderer for directions and bind it to the map.
  var rendererOptions = {
    map: map
  }
  directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);

  // Instantiate an info window to hold step text.
  stepDisplay = new google.maps.InfoWindow();
  
  if(myOpt==1)	//current location
	{	  // Try HTML5 geolocation
		 if(navigator.geolocation) 
		  { 
		    navigator.geolocation.getCurrentPosition(function(position) 
		    		{
		    			var pos = new google.maps.LatLng(position.coords.latitude,
		                                       position.coords.longitude);

		    			currPos=pos;//curr pos is a global var.
		    			calcRoute();//in map/js

		   			 }, function() {handleNoGeolocation(true);});
		  } 
		  else {
		    // Browser doesn't support Geolocation
		    handleNoGeolocation(false);
		  }


			function handleNoGeolocation(errorFlag) 
			{
			  if (errorFlag)
			  {
			    var content = 'Error: The Geolocation service failed.';
			  } 
			  else
			  {
			    var content = 'Error: Your browser doesn\'t support geolocation.';
			  }
			  var options = {
					map: map,
					position:destPos,
					content: content
				};
					var infowindow = new google.maps.InfoWindow(options);
					map.setCenter(options.position);

			} 
	}//case current location ends
else if(myOpt==2)
  {	
  		var returntext='<form id="askUserLoc"><br>'+'Enter a valid starting Location : <input type="text" name="start" value="Connaught Place, New Delhi"> &nbsp;'+
		'<button onclick="fetchRoute();">Get directions</button>'+'</form>'; 
		document.getElementById("getLoc").innerHTML = returntext;
  }

					  
}

function fetchRoute()
{
	var x = document.getElementById("askUserLoc");

    currPos=x.elements[0].value;
    calcRoute();
    
}

//google.maps.event.addDomListener(window, 'load', initialize);

	</script>
	<script src="javascripts\map.js"></script>
</head>
<body onload="initialize();">
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
			<div id="map-canvas"></div>
			<div id="warnings_panel" style="width:100%;height:10%;text-align:center"></div>
			<div id="getLoc"></div>
		</div>
		<script>initialize();</script>
  </body>
</html>