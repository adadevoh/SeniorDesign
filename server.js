var net = require('net');

var HOST = 'localhost';
var PORT = 1345;

net.createServer(function(sock){
	console.log('connected! ' + sock.remoteAddress + ':' + sock.remotePort);

	sock.on('data', function(data){
		console.log('DATA: ' + sock.remoteAddress + ':' + data);

		sock.write('you said: ' + data);

		/*scket io segment*/
		var app = require('http').createServer(handler)

		var io = require('socket.io')(app);

		var fs = require('fs');

		app.listen(1346);
		console.log("node server listening too");

		function handler (req, res) {
			res.end();

			return;
		  
		}

		io.on('connection', function(socket){

			socket.emit('data','test');

			socket.on('event', function(data){
				console.log(data);
				//return;
			});
			//return;

			//setTimeout(socket.disconnect('unauthorized'), 10000 );

			
			
		});
		/*end socket IO segment */

	})
}).listen(PORT, HOST);

console.log('Server listening on ' + HOST +':'+ PORT);


/*socket  io segment */

/*io.on('connection', function (socket) {
	socket.emit('news', { hello: 'world' }); //sending to web client
	socket.on('my other event', function (data) {
			console.log(data); 
	    
		});

});*/

/*io.on('connection', function(socket){
	socket.on('arduino', function(data){
		socket.emit('coordinates', data);
		console.log(data);
	});

});*/