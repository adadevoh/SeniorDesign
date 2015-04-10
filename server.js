var config = require('config').default;
var net = require('net');
var HOST = config.host;
var PORT = 1345;

var mysql = require('mysql');
var connection = mysql.createConnection({
	host      :  HOST,
	user      :  config.mysql.user,
	password  :  config.mysql.password,
	database  :  config.mysql.database
});

var nodemailer = require('nodemailer');
var express = require('express');
var app = express();

var smtpTrans = nodemailer.createTransport(config.mail.trolley.server,{
	service: config.mail.trolley.service,
	auth: {
		user: config.mail.trolley.auth.user,
		pass: config.mail.trolley.auth.pass
	}
});

var io = require('socket.io').listen(1346);

function myFunction(lat1, lng1, lat2, lng2, loc) {
	//console.log("myFunc: "+ lat1 + " " + lng1 + " "+loc);

	if(lat1 < 28.063780 && lng1 < -80.620700 ){//commons
		var d = new Date();
		connection.query("SELECT user FROM locations WHERE location = '"+loc+"' AND time LIKE '"+d.getHours()+"%'  ", 
			function(err, rows, fields){
			if(!err){
				console.log('the solution is: ', rows);
				rows.forEach(function(row){
					console.log(row.user);
					var mailOptions ={
						to       : row.user,
						subject  : "TramSys Alert",
						text     : "Hello, the trolley is near " + loc
					}
					smtpTrans.sendMail(mailOptions, function(err, response){
						if(err){
							console.log(err);
						}
						else{
							console.log("message sent: " + response);
						}
					});
				});
			}
			else
				console.log('error with query: ' + err);					
			});
	}
}


//var app = require('express').listen(3000); //why doesn't this work??

app.listen(3000, function(){
	console.log('nodemailer started');
});



//create socket io server, and listen on port 1346



io.on('connection', function(socket){
	socket.on('coordinates', function(data){
		console.log(data);
		data = data.toString();
		data = data.split(",");
		console.log(data);

		myFunction(data[0], data[1], 1, 2, "commons");

		//wfit
		myFunction(data[0], data[1], 1, 2, "wfit");

		//pdh
		myFunction(data[0], data[1], 1, 2, "pdh");

		//olin
		myFunction(data[0], data[1], 1, 2, "olin");

		//pOffice
		myFunction(data[0], data[1], 1, 2, "pOffice");
	});

});
/*
//pdh = 28.062745, -80.622921
olin = 28.062809, -80.623533

commons = 28.063501, -80.620977 ==> <28.063780, <-80.620700
wfit = 28.064248, -80.623179 ==> >28.064217, <-80.622580

pOffice = 28.065744, -80.624900
Quad = 28.067609, -80.624627
*/



// create tcp server
net.createServer(function(sock){
	console.log('connected! ' + sock.remoteAddress + ': ' + sock.remotePort);

	sock.on('data', function(data){//from arduino
		console.log('DATA: ' + sock.remoteAddress + ': ' + data);

		sock.write('you said: ' + data);

		data = data.toString();
		console.log(data)

		data = data.split(",");
		if(!data){
			console.log("message");
		}
		
		//commons
		myFunction(data[0], data[1], 1, 2, "commons");

		//wfit
		myFunction(data[0], data[1], 1, 2, "wfit");

		//pdh
		myFunction(data[0], data[1], 1, 2, "pdh");

		//olin
		myFunction(data[0], data[1], 1, 2, "olin");

		//pOffice
		myFunction(data[0], data[1], 1, 2, "pOffice");

		//once TCP socket recieves data, the socket.io server forwards it to web client 
		//io.emit('coordinates', data);

	})
}).listen(PORT, HOST);

console.log('Server listening on ' + HOST +': '+ PORT);
