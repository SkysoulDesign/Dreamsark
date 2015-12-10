module.exports = function (e, scene, camera, elements) {

    return {

        /**
         * Manually Load Assets
         */
        load: [elements.Cube, elements.Logo, elements.Particles, elements.Circle, elements.Percentage],

        setup: function () {

            var mouse = e.module('mouse'),
                tween = e.module('tween');

            /**
             * Percentage text
             */
            var percentage = elements.Percentage;
            percentage.text.position.setZ(0.8);

            /**
             * Starting Logo
             */
            var logo = elements.Logo;
            logo.scale.set(.5, .5, .5);
            logo.position.setY(2);

            /**
             * Play Button
             */
            var startButton = elements.Cube.clone(),
                startText   = elements.Percentage.clone('Start');

            startButton.position.set(-2, -1, 0);
            startButton.add(startText.text);

            /**
             * skip Button
             */
            var skipButton = elements.Cube.clone(),
                skipText   = elements.Percentage.clone('Skip');

            skipButton.material = new THREE.MeshBasicMaterial({color: 0xFFE401, wireframe: true});
            skipButton.position.set(2, -1, 0);
            skipButton.add(skipText.text);

            /***
             * Loading Circle
             */
            var loadingCircle = elements.Circle;
            loadingCircle.position.set(0, 2, 5);
            loadingCircle.geometry.rotateX(Math.PI / 2);

            /**
             * Particles
             */
            var particles = elements.Particles;
            particles.mesh.rotateX(Math.PI / 2);

            /**
             * When Click on the start button
             */
            mouse.click(startButton, function () {

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

                /**
                 * Show Percentage Bar
                 */
                var percentageScale = {
                    scale: 0
                };

                tween.add(percentageScale, 1, {
                    scale: 1,
                    delay: 0.5,
                    ease: Power3.easeInOut,
                    onStart: function () {
                        scene.add(percentage.text);
                    },
                    onUpdate: function () {
                        percentage.text.scale.set(percentageScale.scale, percentageScale.scale, percentageScale.scale);
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
                var logoPositions          = logo.geometry.getAttribute('position'),
                    loadingCirclePositions = loadingCircle.geometry.vertices;

                /**
                 * Grab some Particles and set the destination to the logo Position
                 */
                particles.for('particles', logoPositions.count, function (i) {

                    return {
                        x: logoPositions.array[i * 3],
                        y: logoPositions.array[i * 3 + 1],
                        z: logoPositions.array[i * 3 + 2]
                    };

                });

                particles.for('circle', loadingCirclePositions.length, function (i) {
                    return loadingCirclePositions[i];
                });

                /**
                 * Tween the Particles back to the logo
                 */
                particles.tween('circle', 2);
                particles.tween('particles', 3);

                /**
                 * Start Loading
                 */
                e.start(function (on) {

                    on.start = function () {
                        console.log('starting')
                    };

                    on.progress = function (progress) {
                        percentage.update(progress + "%");
                    };

                    on.load = function () {
                        percentage.update("loaded, get ready");

                    };

                    e.compositor.next();

                });

                /**
                 * Remove Click Event
                 */
                return true;

            });

            scene.add(logo, particles.mesh, startButton, skipButton);

        },

        share: function () {
            return {}
        },

        animation: function () {

            //elements.Cube.rotation.x += 0.05;
            //elements.Cube.rotation.y += 0.05;
            //elements.Cube.rotation.z += 0.05;
        }

    };

}
;