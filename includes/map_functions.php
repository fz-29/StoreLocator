<?php

	function scriptformap()
	{
		global $lat,$lng,$address,$storename;	
			$mymapscript="
				<script src=\"https://maps.googleapis.com/maps/api/js?v=3.exp\"></script>
				<script>
					var myLat={$lat};
					var myLng={$lng};
					var myAdd='{$address}';
					var myName='{$storename}';
					/*Creating a coords*/
					var myLatlng=new google.maps.LatLng(myLat,myLng);
					
					var map;
					var myinfowindow;
					
					function initialize() 
					{	/*creating mapOption  object*/
						var mapOptions = {
						zoom: 19,
						center: myLatlng
						};
						/*create a map object*/
						map = new google.maps.Map(document.getElementById('map-canvas'),
						      mapOptions);
						/*create a marker*/
						var mymarker = new google.maps.Marker({
						position: myLatlng,
						map: map,
						title: myName });
						/*creat content for box in html type*/
						   var contentString = '<div id=\"content\" style=\"min-height:110px;min-width: 350px;\">'+
											      	'<div id=\"siteNotice\">'+
											      	'</div>'+
											      	'<h1 id=\"firstHeading\" class=\"firstHeading\">'+myName+'</h1>'+
											      	'<div id=\"bodyContent\">'+
											      		'<p><b>'+myAdd+'</b><br>'+'<br>'+myLat+' , '+myLng+'</p>'+
											      	'</div>'+
											    '</div>';
							/*create info window */
							myinfowindow = new google.maps.InfoWindow({
			      			content: contentString
			      			});
							/*add click listener over ther marker so that it can be opened again if some one close the infowindow*/
			  				google.maps.event.addListener(mymarker, 'click', function() {
							myinfowindow.open(map,mymarker);
							});
			  				/*now call the info window on marker*/
			  				myinfowindow.open(map,mymarker);
						 
			  		}
			  		

			  		
					/*google.maps.event.addDomListener(window, 'load', initialize); /*ALT method*/
			  	</script>
			";
		return $mymapscript;
	}
?>
