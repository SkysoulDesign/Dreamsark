module.exports = (function (e) {

    /**
     * Append Camera to Engine
     */
    return e.camera = {

        camera: null,
        target: null,
        followEnabled: true,

        init: function () {

            var config = {
                fov: 45,
                aspect: window.innerWidth / window.innerHeight,
                near: 1,
                far: 1e7
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

                return !this.followEnabled;

            }, this);

        },

        center: function () {

            var tween      = e.module('tween').class,
                camera     = this.camera,
                origin     = {
                    position: this.camera.position.clone(),
                    rotation: this.camera.rotation.toVector3()
                },
                parameters = {
                    position: new THREE.Vector3(0, 0, 100),
                    rotation: new THREE.Vector3(0, 0, 0)
                };

            tween.create(parameters, {ease: 'expoInOut', duration: 2, origin: origin}, function (param) {
                camera.position.copy(param.position);
                camera.rotation.setFromVector3(param.rotation);
            });

        },

        moveTo: function (element) {

            var tween    = e.module('tween').class,
                camera   = this.camera,
                distance = new THREE.Vector3(10, 10, 10);

            var clone = camera.clone();
            clone.lookAt(element.position);

            var initialQuaternion = camera.quaternion.clone();
            var endingQuaternion  = clone.quaternion;
            var targetQuaternion  = new THREE.Quaternion();

            /**
             * Element position needs to fix
             * @type {{time: number, position: *}}
             */
            var destination = {time: 1, position: element.position.clone().sub(distance)},
                origin      = {
                    time: 0,
                    position: camera.position
                };

            tween.create(destination, {duration: 2, origin: origin}, function (param) {

                camera.position.set(param.position.x, param.position.y, param.position.z);

                THREE.Quaternion.slerp(initialQuaternion, endingQuaternion, targetQuaternion, param.time);
                camera.setRotationFromQuaternion(targetQuaternion);

            });

            //tween.create(parameters, {origin: origin, duration: 2}, function (param) {
            //    camera.position.set(param.position.x, param.position.y, param.position.z);
            //});

        }

    };

})(Engine);