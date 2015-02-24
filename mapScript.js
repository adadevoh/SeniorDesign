//var googleMap = require();
var myVar = setInterval(function(){ success() }, 10000);

$(document).ready(function(){
	if(navigator.geolocation){
		var option = {
			enableHighAccuracy	: true,
			timeout 			: Infinity,
			maximumAge 			: 0
		};
		navigator.geolocation.watchPosition(success, fail, option);
	}
	else
		$("div#map-canvas").html("HTML5 NOT Supported");

});

function success(){
	
	var x = get_x();
	var y = get_y();

	var googleLatLng = new google.maps.LatLng(x,
											  y);
	var mapOptions = {
		zoom		: 18,
		center 		: googleLatLng,
		scaleControl: false,
		scrollwheel: false,
		mapTypeId 	: google.maps.MapTypeId.ROAD,
		
	}

	var pMap = document.getElementById("map-canvas");

	var map = new google.maps.Map(pMap, mapOptions);
	addMarker(map, googleLatLng, "Trolley");	
	
	

}

function addMarker(map, googleLatLng, title){
	var markerOptions = {
		position 	:googleLatLng,
		map 		:map,
		title 		:title,
		animation	:google.maps.Animation.BOUNCE
	};

	var marker = new google.maps.Marker(markerOptions);
	//setInterval(addMarker, 3000);
}



function fail(error){
	var errorType = {
		0: "Unknown Error",
		1: "Permission denied",
		2: "UNable to locate position",
		3: "Request timed out"
	};

	var errMsg = errorType[error.code];
	if(error.code == 0 || eoor.code == 2){
		errMsg = errMsg + " " + error.message;
	}

	$("div#map-canvas").html(errMsg);
}

function get_x()
{
	var d = new Date();
	var n = d.getHours();
	var m = d.getMinutes();
	var s = d.getSeconds();
	
	console.log(s);
	
	if( s >= 0 && s <= 9){
		var x = 28.063211;
	}
	if( s >= 10 && s <= 19){
		var x = 28.062757;
	}
	if( s >= 20 && s <= 29){
		var x = 28.063403;
	}
	if( s >= 30 && s <= 39){
		var x = 28.064230;
	}
	if( s >= 40 && s <= 49){
		var x = 28.065662;
	}
	if( s >= 50 && s <= 59){
		var x = 28.067591;
	}
	
	return x;
	
}

function get_y(){
	var d = new Date();
	var n = d.getHours();
	var m = d.getMinutes();
	var s = d.getSeconds();
	
	if( s >= 0 && s <= 9){
		var y = -80.623880;
	}
	if( s >= 10 && s <= 19){
		var y = -80.622929;
	}
	if( s >= 20 && s <= 29){
		var y = -80.620757;
	}
	if( s >= 30 && s <= 39){
		var y = -80.623130;
	}
	if( s >= 40 && s <= 49){
		var y = -80.624871;
	}
	if( s >= 50 && s <= 59){
		var y = -80.624643;
	}
		
	return y;
}


