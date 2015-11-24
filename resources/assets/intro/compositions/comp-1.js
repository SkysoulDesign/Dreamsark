module.exports = (function (e) {

    return {

        constructor: function (E) {
            return {}
        },

        setup: function (data, E) {

            /**
             * Scene Settings
             */
            e.scene.a.add(E.particles, E.skybox);

            /**
             * Camera Settings
             */
            e.camera.a.position.z = 20;

            /**
             * Plugin Init
             */
            e.plugins.OrbitControls.init();

            //e.helpers.timeout(5000, function () {
            //    e.compositor.next();
            //});

        },

        animation: function (data, E) {

            for (var i = 0; i < data.max; i++) {

            }

        }

    };

})(Engine);