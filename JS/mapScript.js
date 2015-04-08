//var googleMap = require();

/*var net = require('net');

var HOST = '127.0.0.1';
var PORT = 1345;

var client = new net.Socket();
client.connect(PORT, HOST, function() {

    console.log('CONNECTED TO: ' + HOST + ':' + PORT);
    // Write a message to the socket as soon as the client is connected, the server will receive it as message from the client 
    client.write('I am Chuck Norris!');

});

// Add a 'data' event handler for the client socket
// data is what the server sent to this socket
client.on('data', function(data) {
    
    console.log('DATA: ' + data);
    // Close the client socket completely
    client.destroy();
    
});

// Add a 'close' event handler for the client socket
client.on('close', function() {
    console.log('Connection closed');
});*/

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


//coordinates 
/*
	var socket = io('http://localhost:1345');
	socket.on('coordinates', updateMap);
*/

function updateMap(data) {

}

/*
function success(data){
	//data = gps coordinates
	var googleLatLng = new google.maps.LatLng(data);
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

*/

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


