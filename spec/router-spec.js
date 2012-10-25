if ( typeof require != "undefined") {
    var buster = require("buster");
	var util = require('util');
	var http = require('http');
	var url = require("url");
	var server = require("../src/server.js");
	var router = require("../src/router.js");
	var requestHandlers = require("../src/requestHandlers.js");
}

buster.spec.expose(); // Make spec functions global

var spec = describe("First router test", function () {
	
    before(function (done) {
			testrouter = '';
			pathname = '';
			response = '';
			request = '';
			pathname = '/';
			handle = {};
			handle["/"] = requestHandlers.start;
			spyrouter = this.spy(router, "route");	
			router.route(handle, pathname, response, request);

				done();
    });
		
		after(function (done) {
			
			done();
		});
		
   it(":: is the router operational", function (done) {

							buster.assert.defined(router);
							buster.assert.calledOnce(spyrouter);
							buster.assert.calledWith(spyrouter, handle, pathname, "", "");

							done();

						});
		
	});  // closes spec