module DreamsArk.Elements {

    export class Plexus implements Loadable {

        public instance:any;

        data(){
            return {}
        }

        create(maps, objs, data) {

            var maxParticleCount = 500;
            var particles = new THREE.BufferGeometry();
            var particlePositions = new Float32Array(maxParticleCount * 3);

            for (var i=0; i < maxParticleCount; i++) {

                var x = Math.random() * 2000 - 1000;
                var y = Math.random() * 2000 - 1000;
                var z = Math.random() * 2000 - 1000;

                particlePositions[i * 3] = x;
                particlePositions[i * 3 + 1] = y;
                particlePositions[i * 3 + 2] = z;

                //particle.velocity = new THREE.Vector3(-0.5 + Math.random(), -0.5 + Math.random(), -0.5 + Math.random()).multiplyScalar(SPEED);
                //particle.nearParticles = [];

            }

            var PointMaterial = new THREE.PointsMaterial({
                //color: 0x000000,
                size: 2,
                transparent: true,
                alphaTest: 0.01,
                sizeAttenuation: true,
            });

            particles.addAttribute('position', new THREE.BufferAttribute(particlePositions, 3).setDynamic(true));

            return new THREE.Points(particles, PointMaterial);

        }

    }

}