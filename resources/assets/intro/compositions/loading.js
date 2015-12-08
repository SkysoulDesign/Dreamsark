module.exports = function (e, scene, camera, elements) {

    return {

        load: [elements.Cube, elements.Logo, elements.Particles],

        setup: function () {

            /**
             * Manually Load Assets
             */
            //console.log('lelll')
            //camera.position.z = 10;
            //camera.position.y = 50;

            var mouse   = e.module('mouse'),
                tween   = e.module('tween'),
                checker = e.module('checker').class;

            elements.Particles.rotateX(Math.PI / 2);

            mouse.click(elements.Cube, function () {

                var particles     = elements.Particles,
                    logo          = elements.Logo,
                    logoPositions = logo.geometry.getAttribute('position'),
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

                tween.create(final, 1, function (obj) {

                    e.helpers.for(positions.count, function (i) {

                        positions.array[i * 3]     = origin[i * 3] - obj[i].x;
                        positions.array[i * 3 + 1] = origin[i * 3 + 1] - obj[i].y;
                        positions.array[i * 3 + 2] = origin[i * 3 + 2] - obj[i].z;

                    });

                    positions.needsUpdate = true;

                });

            });

            scene.add(elements.Particles, elements.Cube);

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

};