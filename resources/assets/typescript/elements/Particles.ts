module DreamsArk.Elements {

    import For = DreamsArk.Helpers.For;
    import random = DreamsArk.Helpers.random;

    export class Particles implements Loadable {

        public instance:any;

        maps():{} {
            return {particle: 'lib/spark.png'}
        }

        data():{} {
            return {velocity: []}
        }

        create(maps, objs, data) {

            var maxParticleCount = 1000,
                radius = 50;

            var PointMaterial = new THREE.PointsMaterial({
                //color: 0x000000,
                size: 2,
                blending: THREE.AdditiveBlending,
                map: maps.particle,
                transparent: true,
                alphaTest: 0.01,
                sizeAttenuation: true,
                opacity:0.8

            });

            var particles = new THREE.BufferGeometry();
            var particlePositions = new Float32Array(maxParticleCount * 3);

            /**
             * Add Vertices to Points
             */
            For(maxParticleCount, function (i) {

                var vector = random.vector3(0, 0, 0, radius, true);

                particlePositions[i * 3] = vector.x;
                particlePositions[i * 3 + 1] = vector.y;
                particlePositions[i * 3 + 2] = vector.z;

                data.velocity.push(
                    new THREE.Vector3(10 * Math.random(), 10 * Math.random(), 10 * Math.random())
                );

            });

            particles.addAttribute('position', new THREE.BufferAttribute(particlePositions, 3).setDynamic(true));

            return new THREE.Points(particles, PointMaterial);

        }

    }

}