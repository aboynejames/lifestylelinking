var querystring = require("querystring");
var fs = require("fs");
var util = require('util');
var http = require('http');
var url = require("url");
var server = require("../src/server.js");
var router = require("../src/router.js");
var requestHandlers = require("../src/requestHandlers.js");

function start(route, handle) {

    var app = http.createServer(onRequest).listen(8881);
	
	function onRequest(request, response) {
	
    var pathname = url.parse(request.url).pathname;
  
    console.log("Request for " + pathname + " received.");
    route(handle, pathname, response, request);
				
  }

}	
	

exports.start = start;