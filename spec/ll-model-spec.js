/*
if ( typeof require != "undefined") {
	var buster = require("buster");
	var util = require('util');
	var http = require('http');
	var url = require("url");
	var server = require("../src/server.js");
	var router = require("../src/router.js");
	var requestHandlers = require("../src/requestHandlers.js");
}

buster.testCase("Multi-environment", {
    "runs in all environments": function () {
        assert(true);
    },

    "sub context": {
        requiresSupportFor: { "DOM": typeof document != "undefined" },

        "only runs in browser-like environments": function () {
            // ...
					assert(true);
        }
    }
});
*/