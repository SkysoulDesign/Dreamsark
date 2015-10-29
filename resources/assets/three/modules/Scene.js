module.exports = (function () {

    var config = Configs.scene;
    var scene = new THREE.Scene();

    Object.keys(config).map(function (key) {
        scene[key] = config[key];
    });

    return scene;
})();