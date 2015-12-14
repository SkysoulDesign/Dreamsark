module.exports = function (e, scene, camera, elements) {

    return {

        setup: function () {

            var mouse = e.module('mouse'),
                tween = e.module('tween');

            /**
             * Logo
             */
            var logo            = elements.Logo,
                logoDestination = {
                    rotation: new THREE.Vector3(logo.rotation.x, logo.rotation.y, Math.PI * 2)
                }, logoOrigin   = {
                rotation: logo.rotation.toVector3()
            };

            tween.create(logoDestination, {ease: 'quintInOut', origin: logoOrigin, duration: 3}, function (param) {
                logo.rotation.setFromVector3(param.rotation);
            });

            /**
             * Particles
             */
            var particles = elements.Particles;
            particles.reset();

            /**
             * Fade in the skybox
             */
            var skybox            = elements.Skybox,
                skyboxDestination = {
                    opacity: 1
                };

            tween.create(skyboxDestination, 2, function (param) {
                skybox.material.opacity = param.opacity;
            });

            /**
             * Remove Percentage Button
             */
            var percentage            = elements.Percentage,
                percentageOrigin      = {
                    scale: percentage.text.scale.clone()
                },
                percentageDestination = {
                    scale: new THREE.Vector3(0, 0, 0)
                },
                percentageComplete    = function () {
                    scene.remove(percentage.text);
                };

            tween.create(percentageDestination, {duration: 1, origin: percentageOrigin, complete: percentageComplete},
                function (param) {
                    percentage.text.scale.copy(param.scale)
                });

            /**
             * Singularity
             */
            var singularity          = elements.SingularityBuffer,
                singularityPositions = singularity.getAttribute('position');

            particles.for('singularity', singularityPositions.count, function (i) {

                return {
                    x: singularityPositions.array[i * 3],
                    y: singularityPositions.array[i * 3 + 1],
                    z: singularityPositions.array[i * 3 + 2]
                };

            });

            /**
             * Expand the particles back in
             */
            var expandUniverse = function () {

                particles.reset();

                /**
                 * Universe Buffer
                 */
                var universe          = elements.UniverseBuffer;
                var universePositions = universe.getAttribute('position');

                particles.for('universe', universePositions.count, function (i) {

                    return {
                        x: universePositions.array[i * 3],
                        y: universePositions.array[i * 3 + 1],
                        z: universePositions.array[i * 3 + 2]
                    };

                });

                /**
                 * Build Universe
                 */
                particles.tween('universe', 2, {

                    complete: function () {

                        /**
                         * Initialize Controls
                         */
                        camera.class.initControls();

                    }

                });

                /**
                 * Add Plexus
                 */
                var plexus = elements.Plexus;

                /**
                 * Add Hover Mouse
                 */
                e.helpers.keys(plexus.children, function (el) {

                    var hoverIn  = function (element) {

                            var destination = {size: 25},
                                options     = {
                                    ease: 'expoInOut',
                                    origin: element.material.size,
                                    duration: 0.5
                                },
                                update      = function (param) {
                                    element.material.size = param.size;
                                };

                            tween.create(destination, options, update);

                        },
                        hoverOut = function (element) {

                            var destination = {size: 10},
                                options     = {
                                    ease: 'elasticOut',
                                    origin: element.material.size,
                                    duration: 0.3
                                },
                                update      = function (param) {
                                    element.material.size = param.size
                                };

                            tween.create(destination, options, update);

                        },
                        click    = function (element) {
                            camera.class.moveTo(element);
                        };

                    mouse.hoverClick(el, hoverIn, hoverOut, click);

                });

                scene.add(plexus);

            };

            particles.tween('singularity', 2, {
                ease: 'quadInOut', complete: expandUniverse
            });

            scene.add(skybox)

        },

        animation: function () {

        }

    }

}
;