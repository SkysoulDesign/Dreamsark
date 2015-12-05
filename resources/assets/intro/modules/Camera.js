module.exports = (function (e) {

    /**
     * Append Camera to Engine
     */
    return e.camera = {

        camera: null,

        init: function () {

            var config = {
                fov: 45,
                aspect: window.innerWidth / window.innerHeight,
                near: 1,
                far: 40000
            };

            /**
             * Camera
             * @type {THREE.PerspectiveCamera}
             */
            this.camera = new THREE.PerspectiveCamera(config.fov, config.aspect, config.near, config.far);

        }

    };

})(Engine);