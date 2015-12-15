module.exports = (function () {

    return {

        name: 'Plexus',

        maps: function () {
            return {
                point1: 'lib/point-1.png',
                point2: 'lib/point-2.png',
                point3: 'lib/point-3.png',
                point4: 'lib/point-4.png'
            }
        },

        create: function (e, share, maps, objs) {

            var group = e.helpers.group();

            /**
             * Add Vertices to Points
             */
            e.helpers.for(50, function (i) {

                var particles         = new THREE.BufferGeometry();
                var particlePositions = new Float32Array(3);

                var vector = e.helpers.random3(0, 0, 0, 1000 / 4, false);

                var material = new THREE.PointsMaterial({
                    map: maps['point' + e.helpers.random(1, 4)],
                    size: 10,
                    transparent: true,
                    sizeAttenuation: true,
                    alphaTest: 0.2
                });

                particles.addAttribute('position', new THREE.BufferAttribute(particlePositions, 3).setDynamic(true));

                var point = new THREE.Points(particles, material);

                /**
                 * Set Point Meta Data
                 * @type {{src: *, title: string, description: string}}
                 */
                point.userData = {
                    src: material.map.image.src,
                    title: 'Project Beta Tittle',
                    description: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias corporis deleniti deserunt eveniet expedita fuga fugiat.'
                };

                /**
                 * Set Position in real world so can be accessible by lookAt
                 */
                point.position.copy(vector);

                group.add(point);

            });

            return group;

        }

    }

})();