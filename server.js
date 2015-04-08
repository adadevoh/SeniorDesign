var net = require('net');

var HOST = 'localhost';
var PORT = 1345;

/*socket io segment*/
/*var app = require('http').createServer(function(req, res){
	return res.end;
});

var io = require('socket.io')(app);

app.listen(1346, function(){
	console.log("node server listening too");
});*/
/*end socket IO segment */

//create sockeet io server, and listen on port 1346

var io = require('socket.io').listen(1346, function(){
	console.log("node server listening too");
});


// create tcp server
net.createServer(function(sock){
	console.log('connected! ' + sock.remoteAddress + ': ' + sock.remotePort);

	sock.on('data', function(data){
		console.log('DATA: ' + sock.remoteAddress + ': ' + data);

		sock.write('you said: ' + data);		

		data = data.toString();


		io.on('connection', function(socket){

			//socket.emit('coordinates', JSON.stringify(data));
			socket.emit('coordinates', data);

			socket.on('response', function(data){
				console.log(data);
			});		
			
		});

	})
}).listen(PORT, HOST);

console.log('Server listening on ' + HOST +':'+ PORT);
