var config = require('config').default;
var net = require('net');
var io = require('socket.io').listen(1346);
var mysql = require('mysql');
var nodemailer = require('nodemailer');
var express = require('express');


var HOST = config.host;
var PORT = 1345;
var connection = mysql.createConnection({//create mysql connection
	host      :  HOST,
	user      :  config.mysql.user,
	password  :  config.mysql.password,
	database  :  config.mysql.database
});
var app = express();
var smtpTrans = nodemailer.createTransport(config.mail.trolley.server,{
	service: config.mail.trolley.service,
	auth: {
		user: config.mail.trolley.auth.user,
		pass: config.mail.trolley.auth.pass
	}
});

//var app = require('express').listen(3000); //why doesn't this work??

//testing email function
/*loc = "pdh";
var mailOptions ={
	to       : "jadadevoh2008@fit.edu",
	subject  : "TramSys Alert",
	text     : "Hello, the trolley is near "+loc
}
smtpTrans.sendMail(mailOptions, function(err, response){
	if(err){
		console.log(err);
	}
	else{
		console.log(response);
	}
});
console.log("testing email function");
*/


function myFunction(loc) {
	console.log("myFunc");
	var d = new Date();console.log(d.getHours());
	connection.query("SELECT user FROM locations WHERE location = '"+loc+"' AND time LIKE '"+d.getHours()+"%'  ", 
		function(err, rows, fields){
			if(!err){
				console.log('the solution is: ', rows);
				console.log(rows.length);
				
				if(rows.length > 0){
					rows.forEach(function(row){///start
					console.log(row.user);console.log("sending to "+ row.user);
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
				});//end
			}
		}
		else
			console.log('error with query: ' + err);					
		});
}


app.listen(3000, function(){
	console.log('nodemailer started');
});



io.on('connection', function(socket){
	socket.on('coordinates', function(data){
		console.log("socket.io: "+data);
		data = data.toString();
		data = data.split(",");
		console.log(data);
		data[0] = data[0] - 1 + 1;// to cenvert it to  decimal
		data[1] = data[1] - 1 + 1;
		this.emit('response', 'I received the coordinates: ' + data[0] + ","+data[1] );

		if(28.064024 < data[0] && 28.067953 > data[0]){
			if(data[1] > -80.624901 && data[1] < -80.624896){
				myFunction("pOffice");
			}
		}

		if(data[0] > 28.063853 && data[0] < 28.063986){
			if(data[1] > -80.624906 && data[1] < -80.623533){
				myFunction("pdh");
				myFunction("olin");

			}
		}
		
		if(data[0] > 28.062328 && data[0] < 28.063936){
			if(data[1] > -80.623592 && data[1] < -80.623214){
				myFunction("pdh");
				myFunction("olin");

			}
		}
		if(data[0] > 28.064066 && data[0] < 28.064222){
			if(data[1] > -80.623254 && data[1] < -80.619971){
				myFunction("wfit");
			}
		}

		if(data[0] > 28.062804 && data[0] < 28.063985){
			if (data[1] > -80.621457 && data[1] < -80.620582){
				myFunction("commons");
			};
		}

	});
});

// create tcp server
net.createServer(function(sock){
	console.log('connected! ' + sock.remoteAddress + ': ' + sock.remotePort);

	sock.on('data', function(data){//from arduino
		console.log('DATA: ' + sock.remoteAddress + ': ' + data);

		sock.write('you said: ' + data);

	})
}).listen(PORT, HOST);

console.log('Server listening on ' + HOST +': '+ PORT);
