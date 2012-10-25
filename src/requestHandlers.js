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
	response.write(data);
	response.end();
	});
	
}

/**
* add the css files
*
*/
function cssmain(fullpath, response) {
console.log("Request handler 'css' was called.");

	var data  = '';

	if(fullpath[2] == 'main.css')
	{

		fs.readFile('./css/main.css', function(err, data) {
			response.writeHead(200, {"Content-Type": "text/css"});
			response.end(data);
		});
  }
	else if(fullpath[2] == 'reset.css')
	{
		
		fs.readFile('./css/reset.css', function(err, data) {
			response.writeHead(200, {"Content-Type": "text/css"});
			response.end(data);
		});		
		
	}
	else if(fullpath[2] == 'global-forms.css')
	{

		fs.readFile('./css/global-forms.css', function(err, data) {
			response.writeHead(200, {"Content-Type": "text/css"});
			response.end(data);
		});		
		
	}

}

/**
* add js files
*
*/
function lljs(fullpath, response) {
console.log("Request handler 'js files' was called.");

	var data  = '';

	if(fullpath[2] == 'llcontrol.js')
	{

		fs.readFile('./js/llcontrol.js', function(err, data) {
			response.writeHead(200, {"Content-Type": "text/javascript"});
			response.end(data);
		});
  }
	
}

exports.start = start;
exports.cssmain = cssmain;
exports.lljs = lljs;