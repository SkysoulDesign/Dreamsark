module.exports = (function () {

    var maxParticleCount = 10;
    var radius           = 10;
    var particleCount    = 500;

    return {

        name: 'particles',

        maps: function () {
            return {
                spark: 'lib/spark-9.png'
            }
        },

        create: function (e, share, maps, objs) {

            var PointMaterial = new THREE.PointsMaterial({
                color: 0x000000,
                size: 5,
                //blending: THREE.MultiplyBlending,
                //map: maps.spark,
                sizeAttenuation: true

            });

            var particles         = new THREE.BufferGeometry();
            var particlePositions = new Float32Array(maxParticleCount * 3);

            /**
             * Add Vertices to Points
             */
            e.helpers.for(maxParticleCount, function (i) {

                var x = Math.random() * radius - radius / 2;
                var y = Math.random() * radius - radius / 2;
                var z = Math.random() * radius - radius / 2;

                particlePositions[i * 3]     = x;
                particlePositions[i * 3 + 1] = y;
                particlePositions[i * 3 + 2] = z;

            });

            particles.addAttribute('position', new THREE.BufferAttribute(particlePositions, 3).setDynamic(true));
            //particles.setDrawRange(0, particleCount);

            return new THREE.Points(particles, PointMaterial);

        }


    }

})();