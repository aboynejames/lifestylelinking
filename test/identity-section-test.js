/*
* check the identity section css and links 
*/
var baseUrl = "http://localhost:8881";

casper.test.comment("Scenario: Test Identity section first use");

casper.start(baseUrl, function() {
	this.test.comment('follow delicious identity flow');
	casper.test.assertExists('#delicious', 'the element exists');
	this.click('#delicious');
});

casper.then(function() {
	this.test.comment('delicious tagcloud div should be inserted');
    casper.test.assertExists('#tagcloud', 'the element exists');

});

casper.run(function() {

  this.test.done();

});