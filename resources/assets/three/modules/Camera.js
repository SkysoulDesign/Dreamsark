module.exports = (function () {
    var config = Configs.camera;
    return new THREE.PerspectiveCamera(config.fov, config.aspect, config.near, config.far);
})();