module.exports = (function (e) {

    return e.renderer = {

        renderer: null,

        init: function () {

            var config = {
                antialias: true
            };

            /**
             * Renderer
             * @type {THREE.PerspectiveCamera}
             */
            this.renderer = new THREE.WebGLRenderer(config);

        },

        /**
         * Configure Renderer
         */
        configure: function (configs) {

            e.helpers.appendTo(configs.container, this.domElement);

            //this.setClearColor(scene.a.fog.color);
            this.setPixelRatio(window.devicePixelRatio);
            this.setSize(window.innerWidth, window.innerHeight);

        }

    };

})(Engine);