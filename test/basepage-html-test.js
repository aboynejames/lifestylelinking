/*
* check the homepage index.html webpage has been displayed
*/
var baseUrl = "http://localhost:8881";

casper.test.comment("Scenario: A base layout of the first html page sections");

casper.start(baseUrl, function() {
	this.test.comment('identity section markup present');
	casper.test.assertExists('.identity', 'the element exists');

});

casper.then(function() {
	this.test.comment('life lens sectionmarkup repsent');
	casper.test.assertExists('.lifelens', 'the element exists');
	
});

casper.then(function() {
	this.test.comment('lifestylelinking flow sectionmarkup repsent');
	casper.test.assertExists('.lifeflow', 'the element exists');
	
});

casper.then(function() {
	this.test.comment('clone footer sectionmarkup repsent');
	casper.test.assertExists('.cloneme', 'the element exists');
	
});

casper.run(function() {
// need for exporting xml xunit/junit style
  //this.test.renderResults(true, 0, 'reports/test-casper.xml');
  this.test.done();
	//this.exit(); 
});