module DreamsArk.Compositions {

    import Animator = DreamsArk.Modules.Animator;
    import For = DreamsArk.Helpers.For;

    export class Universe implements Composable {

        elements() {
            return ['Cube'];
        }

        setup(scene, camera, elements) {

            var animator = <Animator>module('Animator');

            var logo = elements.Logo,
                tunnel = elements.Tunnel;

            /**
             * Center Camera
             */
            animator.circOut({
                destination: {
                    position: new THREE.Vector3(0, 0, 50),
                    rotation: new THREE.Vector3(0, 0, 0)
                },
                origin: {
                    position: camera.position,
                    rotation: camera.rotation.toVector3()
                },
                duration: 3,
                update: function (params) {
                    camera.position.copy(params.position);
                    camera.rotation.setFromVector3(params.rotation);
                }
            });

            /**
             * Speed up Logo
             */
            animator.expoIn({
                destination: new THREE.Vector3(0, 0, -700),
                origin: logo.position,
                duration: 5,
                update: function (params) {
                    logo.position.copy(params)
                }
            });

            /**
             * Remove Tunnel
             */
            animator.expoIn({
                destination: new THREE.Vector3(0, 0, 800),
                origin: tunnel.position,
                duration: 5,
                update: function (params) {
                    tunnel.position.copy(params)
                }
            });

            /**
             * Lower Fog
             */
            animator.expoIn({
                destination: {
                    far: 700
                },
                origin: {
                    far: scene.fog.far
                },
                duration: 2,
                update: function (param) {
                    scene.fog.far = param.far
                }
            })

        }

        update(scene, camera, elements) {

            /**
             * Tunnel
             */
            elements.Tunnel.userData.update();

            /**
             * Particles
             * Park every particles at depth 500
             */
            var particles = elements.Particles,
                positions = particles.geometry.getAttribute('position'),
                velocities = particles.userData.velocity;

            For(positions.count, function (i) {
                positions.array[i * 3 + 2] += velocities[i].z;
            });

            positions.needsUpdate = true;

        }

    }

}