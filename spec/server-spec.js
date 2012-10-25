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

var spec = describe("First server test start server", function () {
	
    before(function (done) {

				stubhandle = {};
				stubhandle["/"] = requestHandlers.start;
				
				stubroute = this.stub(router, "route");

				spyserver = this.spy(server, "start");
				server.start(stubhandle, stubroute);	

				done();
    });
		
		after(function (done) {
	
			done();
		});
		
   it(":: is the server alive and well", function (done) {
		 
							buster.assert.defined(server);
							buster.assert.calledOnce(spyserver);
							buster.assert.calledWith(spyserver, stubhandle, stubroute);
							done();

						});
		
	});  // closes spec