module.exports = (function () {
    var config = Configs.camera;
    var camera = new THREE.PerspectiveCamera(config.fov, config.aspect, config.near, config.far);

    return {
        get: function () {
            camera.scope = this;
            return camera;
        },
        set: function ($closure) {
            $closure.call(camera);
        }
    };

})();