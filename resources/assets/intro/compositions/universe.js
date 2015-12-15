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

                            var complete = function () {

                                var tween = e.module('tween').class,
                                    mouse = e.module('mouse').class;

                                var overlay     = document.querySelector('#show-entry'),
                                    closeButton = document.querySelector('#view-project'),
                                    miniature   = document.querySelector('#miniature'),
                                    title       = document.querySelector('#title'),
                                    description = document.querySelector('#description');

                                /**
                                 * Restyle Page
                                 */
                                overlay.style.display = 'block';
                                miniature.src           = element.userData.src;
                                title.textContent       = element.userData.title;
                                description.textContent = element.userData.description;

                                mouse.click(closeButton, function (event) {

                                    overlay.style.display         = 'none';
                                    //camera.position.copy(elements.Logo.position);
                                    //camera.position.z += 50;
                                    //camera.lookAt(elements.Logo.position);

                                    /**
                                     * Re-enable Controls
                                     */
                                    camera.class.initControls();

                                });

                                //
                                //    destination = element.position.clone(),
                                //    origin      = element.position.clone();

                                //destination.x += 20;
                                //destination.y += 10;
                                //destination.z += 10;

                                //console.log(destination)
                                //
                                //tween.create(destination, {duration: 1, origin: origin}, function (param) {
                                //    element.position.copy(param)
                                //});

                            };

                            /**
                             * Move Camera to element
                             */
                            camera.class.moveTo(element, complete);
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