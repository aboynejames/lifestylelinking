buster.spec.expose(); // Make some functions global

describe("A module", function () {
    it("states the obvious", function () {
        expect(true).toEqual(true);
    });
		
		    it("states the the second assert in the first test", function () {
        assert.equals(32, 32);
    });
		
});