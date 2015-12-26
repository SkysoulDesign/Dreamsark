module DreamsArk.Compositions {

    import For = DreamsArk.Helpers.For;
    import length = DreamsArk.Helpers.length;
    import deg2rad = DreamsArk.Helpers.deg2rad;
    import timeout = DreamsArk.Helpers.timeout;
    import Animator = DreamsArk.Modules.Animator;
    import Mouse = DreamsArk.Modules.Mouse;

    export class Loading implements Composable {

        elements() {
            return ['Logo', 'Tunnel', 'Skybox'];
        }

        setup(scene, camera, elements) {

            var animator = <Animator>module('Animator');

            var logo = elements.Logo,
                tunnel = elements.Tunnel,
                skybox = elements.Skybox;

            /**
             * set up camera
             */
            camera.position.z = 30;

            /**
             * Enter with the logo
             */
            animator.expoOut({
                destination: new THREE.Vector3(0, 0, -20),
                origin: logo.position.set(0, 0, 100),
                duration: 3,
                delay: 1,
                update: function (params) {
                    logo.position.copy(params)
                }
            });

            /**
             * Setup Tunnel
             */
            tunnel.rotation.x = deg2rad(90);
            tunnel.material.opacity = 0;
            tunnel.userData = {
                init: function () {
                    this.timer = new THREE.Clock();
                    this.speed = new THREE.Vector2(1.5, 1.5);
                },
                timer: null,
                speed: null,
                update: function () {
                    var tunnelTexture = tunnel.material.alphaMap;

                    tunnelTexture.offset.x = -this.timer.getElapsedTime() / 6 * this.speed.x;
                    tunnelTexture.offset.y = -this.timer.getElapsedTime() / 2 * this.speed.y;

                    tunnel.material.color.setHSL(Math.abs(Math.cos((this.timer.getElapsedTime() / 10))), 1, 0.5);
                }
            };

            tunnel.userData.init();

            animator.expoOut({
                destination: {
                    position: new THREE.Vector3(0, 0, -350),
                    opacity: 1
                },
                origin: {
                    position: tunnel.position.set(0, 0, -1000),
                    opacity: 0
                },
                duration: 3,
                update: function (params) {
                    tunnel.position.copy(params.position);
                    tunnel.material.opacity = params.opacity;
                }
            });

            /**
             * Animate Skybox
             */
            animator.expoOut({
                destination: {
                    opacity: 1
                },
                origin: {
                    opacity: 0
                },
                duration: 3,
                update: function (params) {
                    skybox.material.opacity = params.opacity;
                }
            });

            scene.add(logo, tunnel, skybox);

            /**
             * Reset Particles
             */
            elements.Particles.rotation.set(0, 0, 0);
            elements.Particles.position.set(0, 0, 0);

            /**
             * Fake Loaded
             */
            timeout(10, function () {

                new Composition('Universe')

            })

        }

        update(scene, camera, elements) {

            var mouse = <Mouse>module('Mouse');

            /**
             * Tunnel
             */
            elements.Tunnel.userData.update();

            /**
             * camera
             */
            camera.position.x = mouse.screen.x * 0.03;
            camera.position.y = -mouse.screen.y * 0.05;
            camera.lookAt(scene.position);

            /**
             * Particles
             */
            var particles = elements.Particles,
                positions = particles.geometry.getAttribute('position'),
                velocities = particles.userData.velocity;

            For(positions.count, function (i) {

                positions.array[i * 3 + 2] += velocities[i].z / 2;

                if (positions.array[i * 3 + 2] > 500) {
                    positions.array[i * 3 + 2] = -1500
                }

            });

            positions.needsUpdate = true;

        }

    }

}