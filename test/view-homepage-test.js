/*
* check the homepage index.html webpage has been displayed
*/

var casper = require("casper").create();

var baseUrl = "http://localhost:8866/";

casper.test.comment("Scenario: A user can view the home page");

casper.start(baseUrl, function() {
  this.test.assertHttpStatus(200, "Response is a success if 200 else a fail");
  this.test.assertTitle("LifestyleLinking", "Title is as expected");
});


casper.run(function() {
  this.test.renderResults(true, 0, 'log.xml');
  this.test.done();
});