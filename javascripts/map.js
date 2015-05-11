
function calcRoute() {

  // First, remove any existing markers from the map.
  for (var i = 0; i < markerArray.length; i++) {
    markerArray[i].setMap(null);
  }

  // Now, clear the array itself.
  markerArray = [];

  // Retrieve the start and end locations and create
  // a DirectionsRequest using WALKING directions.
  var request = {
      origin: "Connaught Place, New Delhi",
      destination: destPos,
      travelMode: google.maps.TravelMode.WALKING
  };

  // Route the directions and pass the response to a
  // function to create markers for each step.
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      var warnings = document.getElementById('warnings_panel');
      warnings.innerHTML = '<b>' + response.routes[0].warnings + '</b>';
      directionsDisplay.setDirections(response);
      showSteps(response);
    }
  });
}//function calcRoute

var myRoute;
function showSteps(directionResult) {
  // For each step, place a marker, and add the text to the marker's
  // info window. Also attach the marker to an array so we
  // can keep track of it and remove it when calculating new
  // routes.
  myRoute = directionResult.routes[0].legs[0];

  for (var i = 0; i < myRoute.steps.length; i++) 
  {
  	  var marker = new google.maps.Marker({
      position: myRoute.steps[i].start_location,
      map: map });

	    attachInstructionText(marker, myRoute.steps[i].instructions);
	    markerArray[i] = marker;
  }
  putInfoStartEnd(0);
  putInfoStartEnd(myRoute.steps.length-1);
}


function attachInstructionText(marker, text) {
  google.maps.event.addListener(marker, 'click', function() {
    // Open an info window when the marker is clicked on,
    // containing the text of the step.
    stepDisplay.setContent(text);
    stepDisplay.open(map, marker);
  });
}

function putInfoStartEnd(index)
{	//this function will put start and end message dialogue boxes.
	var i=index;
	if(i==0&&i== myRoute.steps.length-1);
	    {	var heading;
	    	var content;

	    	if(i==0)
	    	{	heading="START";
	    		content="";

	    	}
	    	else
	    	{	
	    		heading="END";
	    		content= myName;    	
	    	}

	    	 var contentString = '<div id=\"content\" style=\"min-height:25px;min-width: 100px;\">'+
												      	'<h1 id=\"firstHeading\" class=\"firstHeading\">'+heading+'</h1>'+
												      	'<div id=\"bodyContent\">'+
												      		'<p><b>'+content+'</b></p>'+
												      	'</div>'+
												    '</div>';
								/*create info window */
								myinfowindow = new google.maps.InfoWindow({
				      			content: contentString
				      			});
								/*add click listener over ther marker so that it can be opened again if some one close the infowindow*/
				  				/*now call the info window on marker*/
				  				myinfowindow.open(map,markerArray[i]);
	    }

}
