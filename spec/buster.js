var config = module.exports;

config["Tests"] = {
    rootPath: "../",
    tests: ["spec/*-spec.js"]
};

config["Browser tests"] = {
    extends: "Tests",
    environment: "browser",
    sources: ["src/*.js"]
};

config["Node tests"] = {
    extends: "Tests",
    environment: "node"
};