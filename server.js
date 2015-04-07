var app = require('http').createServer(handler)

var io = require('socket.io')(app);

var fs = require('fs');

app.listen(1345);
console.log("server listening");

function handler (req, res) {
	res.end();
  
}
io.on('connection', function(socket){

	socket.emit('def','test');

	socket.on('event', function(data){
		console.log(data);
	});

	socket.on('pyevent', function(data){
		console.log(data);
	});
	
});

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