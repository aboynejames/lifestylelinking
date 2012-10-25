if ( typeof require != "undefined") {
    var buster = require("buster");
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
