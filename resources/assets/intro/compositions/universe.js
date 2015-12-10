module.exports = function (e, scene, camera, elements) {

    return {

        setup: function () {

            var mouse = e.module('mouse'),
                tween = e.module('tween');

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
             * Sphere
             */
            var sphere          = elements.Sphere,
                spherePositions = sphere.geometry.getAttribute('position');

            /**
             * Particles
             */
            var particles = elements.Particles;
                particles.reset();

            particles.for('sphere', spherePositions.count, function (i) {

                return {
                    x: spherePositions.array[i * 3],
                    y: spherePositions.array[i * 3 + 1],
                    z: spherePositions.array[i * 3 + 2]
                };

            });

            particles.tween('sphere', 2, {ease: 'quadInOut', complete: function(){
                console.log('terminou')
            }});


            scene.add(sphere)

        },

        animation: function () {

        }

    };

}
;