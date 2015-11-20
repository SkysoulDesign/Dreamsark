module.exports = (function (e) {

    return {

        setup: function (objs) {

            e.helpers.set(objs.ball, function () {
                this.material.color = new THREE.Color('yellow');
            });

            /**
             * Scene Settings
             */
            e.scene.a.add(objs.ball);

            /**
             * Camera Settings
             */
            //e.camera.a.position.z = 5;

            /**
             * Plugin Init
             */
            e.helpers.set(e.plugins.TrackballControls.init(), function () {
                //this.noRotate = true
            });


        },

        animation: function (objs) {

            objs.ball.position.x += .003
            objs.ball.position.y += .001
            objs.ball.position.z += .002;

            e.plugins.TrackballControls.instance.update();

        }

    };

})(Engine);