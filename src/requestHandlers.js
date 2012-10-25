var querystring = require("querystring");
var fs = require("fs");
var util = require('util');
var http = require('http');
var server = require("../src/server.js");
var router = require("../src/router.js");
var requestHandlers = require("../src/requestHandlers.js");
/**
* build the homepage function
*
*/
function start(fullpath, response) {
  console.log("Request handler 'start' was called.");

	var data  = '';

  fs.readFile('./view/llhomepage.html', function(err, data) {
	response.writeHead(200, {"Content-Type": "text/html"});
	//response.write(data);
	response.end(data);
	});	
     
}


exports.start = start;