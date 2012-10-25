var querystring = require("querystring");
var fs = require("fs");
var util = require('util');
var http = require('http');
var server = require("../src/server.js");
var router = require("../src/router.js");
var requestHandlers = require("../src/requestHandlers.js");

function route(handle, pathname, response, request) {

console.log("About to route a request for " + pathname);

	var firstpath = '';
	var firstpath=pathname.split("/"); 

	var pathlive = '/'+firstpath[1];

  if (typeof handle[pathlive] === 'function') {
    handle[pathlive](firstpath, response, request);
  }
  else {

  response.writeHead(404, {"Content-Type": "text/html"});
	response.write("404 Not found");
	response.end();
  }

}

exports.route = route;