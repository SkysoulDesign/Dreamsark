module.exports = (function (e) {

    /**
     * Append Camera to Engine
     */
    return e.camera = {

        camera: null,
        target: null,

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

            this.origin = new THREE.Vector3(0, 0, 20);
            this.target = new THREE.Vector3(0, 0, 0);

            /**
             * Follow Mouse Update
             */
            this.follow();


        },

        configure: function (configs, context) {

            this.position.copy(context.origin);
            this.rotation.order = 'YXZ';

        },

        follow: function () {

            var mouse   = e.module('mouse'),
                browser = e.module('browser');

            e.checker.add(function () {

                var x = (mouse.ratio.x * 200 - 100 - this.camera.position.x),
                    y = -(mouse.ratio.y * 200 - 100) / (browser.innerWidth / browser.innerHeight);
                this.camera.position.x += (x + this.origin.x) / 30;
                this.camera.position.y += (y - this.camera.position.y + this.origin.y) / 30;
                this.camera.lookAt(this.target);

            }, this);

        }

    };

})(Engine);