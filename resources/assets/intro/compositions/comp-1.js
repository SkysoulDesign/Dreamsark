module.exports = (function (e) {

    return {

        setup: function (objs) {

            /**
             * Test Zone
             */

            /**
             * End Test Zone
             */

            /**
             * Scene Settings
             */
            e.scene.a.add(objs.particles, objs.skybox);

            /**
             * Camera Settings
             */
            e.camera.a.position.z = 5;

            /**
             * Plugin Init
             */
            e.helpers.set(e.plugins.TrackballControls.init(), function () {
                //this.noRotate = true
            });

            //e.helpers.timeout(5000, function () {
            //    e.compositor.next();
            //});

        },

        animation: function (objs) {

            e.plugins.TrackballControls.instance.update();

        }

    };

})(Engine);