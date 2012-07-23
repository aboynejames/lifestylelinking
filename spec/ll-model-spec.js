// An example of a spec where the individual Backbone unit is the
// subject under test.

buster.spec.expose();

describe("Snippet.Model", function() {
  describe("when saved", function() {
    beforeEach(function() {
      this.server = sinon.fakeServer.create();
    /*  
      this.attrs = {
        title: "My Snippet",
        content: "My Snippet content"
      };

      this.subject = new Snippet.Model();
      this.subject.save(this.attrs);
*/
	    });

    afterEach(function() {
      this.server.restore();
    });

    it("makes a request to the root", function() {
	    console.log(this.server);
      expect(this.server.requests[0].url)
        .toEqual("/");
    });

    it("submits the correct body", function() {
      var body = JSON.parse(this.server.requests[0].requestBody);
      expect(body.title)
        .toEqual(this.attrs.title);
      expect(body.content)
        .toEqual(this.attrs.content);
    });
  });
});