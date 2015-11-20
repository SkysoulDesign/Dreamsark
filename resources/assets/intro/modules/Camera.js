module.exports = (function (e, c) {

    /**
     * Append Camera to Engine
     */
    return e.camera = {

        /**
         * Active
         */
        a: null,

        init: function (config) {

            config = config ? config : c.camera;

            /**
             * Camera
             * @type {THREE.PerspectiveCamera}
             */
            return this.a = new THREE.PerspectiveCamera(config.fov, config.aspect, config.near, config.far);

        }

    };

})(Engine, Configs);