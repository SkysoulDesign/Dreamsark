module.exports = function (e, scene, camera, elements) {

    return {

        /**
         * Manually Load Assets
         */
        load: [elements.Cube, elements.Logo, elements.Particles, elements.Circle],

        setup: function () {

            var mouse = e.module('mouse'),
                tween = e.module('tween');

            /**
             * Starting Logo
             */
            var logo = elements.Logo;
            logo.scale.set(.5, .5, .5);
            logo.position.setY(2);

            /**
             * Play Button
             */
            var startButton = elements.Cube;
            startButton.position.set(-2, -1, 0);

            /**
             * skip Button
             */
            var skipButton      = elements.Cube.clone();
            skipButton.material = new THREE.MeshBasicMaterial({color: 0xFFE401, wireframe: true});
            skipButton.position.set(2, -1, 0);

            /**
             * Particles
             */
            var particles = elements.Particles;
            particles.rotateX(Math.PI / 2);

            mouse.click(startButton, function () {

                console.log('click')

                var buttonDestination = {
                    start: startButton.position.x,
                    skip: skipButton.position.x,
                    scaleX: skipButton.scale.x,
                    scaleY: skipButton.scale.y,
                    opacity: 1
                };

                /**
                 * Hide Buttons
                 */
                tween.add(buttonDestination, 1, {
                    start: 0.1,
                    skip: 0.1,
                    opacity: 0,
                    scaleX: 0.001,
                    scaleY: 0.001,
                    ease: Power3.easeInOut,
                    onUpdate: function () {

                        startButton.position.x = buttonDestination.start;
                        skipButton.position.x  = skipButton.scale.x = buttonDestination.skip;

                        startButton.scale.set(buttonDestination.scaleX, buttonDestination.scaleY, buttonDestination.scaleY);
                        skipButton.scale.set(buttonDestination.scaleX, buttonDestination.scaleY, buttonDestination.scaleY);

                        startButton.material.opacity = buttonDestination.opacity;
                        skipButton.material.opacity  = buttonDestination.opacity;

                    },
                    onComplete: function () {

                        /**
                         * Remove From Scene when finish
                         */
                        scene.remove(startButton, skipButton);

                    }
                });

                var counter = {
                    scale: logo.scale.x,
                    y: logo.position.y
                };

                /**
                 * Tween Logo Back to 100%
                 */
                tween.add(counter, 1, {
                    scale: 1,
                    y: 0,
                    ease: Power4.easeInOut,
                    onUpdate: function () {
                        logo.scale.set(counter.scale, counter.scale, counter.scale);
                        logo.position.y = counter.y;
                    }
                });

                /**
                 * Particles Cloud
                 */
                var logoPositions = logo.geometry.getAttribute('position'),
                    positions     = particles.geometry.getAttribute('position'),
                    origin        = positions.array.slice();

                var final = [];

                e.helpers.for(positions.count, function (i) {

                    var destination = new THREE.Vector3();

                    destination.x = origin[i * 3] + logoPositions.array[i * 3];
                    destination.y = origin[i * 3 + 1] + logoPositions.array[i * 3 + 1];
                    destination.z = origin[i * 3 + 2] + logoPositions.array[i * 3 + 2];

                    final.push(destination);

                });

                tween.create(final, 2, function (obj) {

                    e.helpers.for(positions.count, function (i) {

                        positions.array[i * 3]     = origin[i * 3] - obj[i].x;
                        positions.array[i * 3 + 1] = origin[i * 3 + 1] - obj[i].y;
                        positions.array[i * 3 + 2] = origin[i * 3 + 2] - obj[i].z;

                    });

                    positions.needsUpdate = true;

                });

                /**
                 * Start Loading
                 */
                e.start();

                /**
                 * Remove Click Event
                 */
                return true;

            });

            scene.add(logo, particles, startButton, skipButton);

        },

        share: function () {
            return {}
        }

        ,

        animation: function () {

            //elements.Cube.rotation.x += 0.05;
            //elements.Cube.rotation.y += 0.05;
            //elements.Cube.rotation.z += 0.05;
        }

    };

}
;