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

var spec = describe("First request handler test", function () {
	
    before(function (done) {
				
				stubhandle = {};
				stubhandle["/"] = requestHandlers.start;
				stubserver = this.stub(server, "start");
				server.start(router.route, stubhandle);

			fullpath = {};
			response ={};
			spyhandler = this.spy(requestHandlers, "start");	
			requestHandlers.start(fullpath, response);
	
				done();
    });
		
		after(function (done) {
			
			done();
		});
		
   it(":: is the router operational", function (done) {

							buster.assert.defined(requestHandlers);
							buster.assert.calledOnce(spyhandler);
							buster.assert.calledWith(spyhandler, {}, {});
							done();

						});
		
	});  // closes spec