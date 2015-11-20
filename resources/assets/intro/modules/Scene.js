module.exports = (function (e, c) {

    /**
     * Append Scene to Engine
     */
    return e.scene = {

        /**
         * Active
         */
        a: null,

        init: function (config) {

            config = config ? config : c.scene;

            /**
             * Scene
             * @type {THREE.Scene}
             */
            var scene = new THREE.Scene();

            Object.keys(c.scene).map(function (key) {
                scene[key] = config[key];
            });

            return this.a = scene;

        }

    };

})(Engine, Configs);