module.exports = function (e, scene, camera, elements) {

    return {

        setup: function () {

            var mouse = e.module('mouse'),
                tween = e.module('tween');

            /**
             * Particles
             */
            var particles = elements.Particles;
            particles.reset();

            /**
             * Fade in the skybox
             */
            var skybox = elements.Skybox;

            tween.add(skybox.material, 3, {
                opacity: 1,
                ease: Power3.easeInOut
            });

            /**
             * Remove Percentage Button
             */
            var percentage = elements.Percentage;

            /**
             * Show Percentage Bar
             */
            var percentageScale = {
                scale: percentage.text.scale.x
            };

            tween.add(percentageScale, 1, {
                scale: 0,
                ease: Power3.easeInOut,
                onComplete: function () {
                    scene.remove(percentage.text);
                },
                onUpdate: function () {
                    percentage.text.scale.set(percentageScale.scale, percentageScale.scale, percentageScale.scale);
                }
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

                particles.tween('universe', 2, {

                    complete: function () {

                        camera.class.followEnabled = false;

                        var controls = new THREE.TrackballControls(camera, e.module('renderer').domElement);
                        var checker  = e.module('checker').class;

                        checker.add(function () {
                            controls.update()
                        })

                    }

                });

            };

            particles.tween('singularity', 2, {
                ease: 'quadInOut', complete: expandUniverse
            });

            scene.add(skybox)

        },

        animation: function () {

        }

    };

};