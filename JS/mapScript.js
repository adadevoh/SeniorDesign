//var googleMap = require();
var myVar = setInterval(function(){ drawChart() }, 10000);

$(document).ready(function(){
	if(navigator.geolocation){
		var option = {
			enableHighAccuracy	: true,
			timeout 			: Infinity,
			maximumAge 			: 0
		};
		navigator.geolocation.watchPosition(drawChart, fail, option);
	}
	else
		$("div#map-canvas").html("HTML5 NOT Supported");

});

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

// onload callback
function drawChart() {

	var public_key = 'KJ6nqR7MX7hbbNd5gz4n';

	 // JSONP request
	 var jsonData = $.ajax({
		url: 'https://data.sparkfun.com/output/' + public_key + '/latest.json',
		data: {page: 1},
		dataType: 'jsonp',
		}).done(function (results) {
				
	// loop through results and log temperature to the console
			$.each(results, function (index, row) {
				var a =  parseFloat(row.lat);
				var b =  parseFloat(row.lon);
				console.log(a);
				console.log(b);
				console.log(row.timestamp);

				var data = a +","+ b;
				var socket = io('http://104.131.82.141:1346');
				socket.emit('coordinates', data);


	var googleLatLng = new google.maps.LatLng(b,
											  a);
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
		
					});
		});
}