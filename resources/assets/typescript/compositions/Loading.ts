module DreamsArk.Compositions {

    import For = DreamsArk.Helpers.For;
    import length = DreamsArk.Helpers.length;
    import deg2rad = DreamsArk.Helpers.deg2rad;
    import timeout = DreamsArk.Helpers.timeout;
    import Animator = DreamsArk.Modules.Animator;
    import Mouse = DreamsArk.Modules.Mouse;
    import query = DreamsArk.Helpers.query;
    import Browser = DreamsArk.Modules.Browser;

    export class Loading implements Composable {

        elements() {
            return ['Particles', 'Tunnel', 'Skybox'];
        }

        setup(scene, camera, elements) {

            var animator = <Animator>module('Animator'),
                mouse = <Mouse>module('Mouse');

            var logo = elements.Logo,
                ren = elements.Ren,
                particles = elements.Particles,
                tunnel = elements.Tunnel,
                skybox = elements.Skybox,
                background = query('.enter-page'),
                domLogo = query('#logo');

            /**
             * Setups
             * @type {{init: (function(): void), timer: null, speed: null, update: (function(): void)}}
             */
            tunnel.userData = {
                init: function () {
                    this.timer = new THREE.Clock();
                    this.speed = new THREE.Vector2(0, -4);
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

            /**
             * Return Camera to Default
             */
            animator.expoOut({
                destination: {
                    position: new THREE.Vector3(0, 0, 30),
                    rotation: new THREE.Vector3(0, 0, 0)
                },
                origin: {
                    position: camera.position,
                    rotation: camera.rotation.toVector3(),
                },
                duration: 1,
                update(params){
                    camera.position.copy(params.position);
                    camera.rotation.setFromVector3(params.rotation)
                }
            });

            /**
             * Lift Ren
             */
            animator.expoOut({
                destination: new THREE.Vector3(0, 7, 3),
                origin: ren.position,
                duration: 1,
                update(params){
                    ren.position.copy(params)
                }
            });

            /**
             * Zoom In Camera
             */
            var animCameraZoomIn = animator.expoIn({
                destination: {
                    zoom: 0.2,
                },
                origin: {
                    zoom: camera.zoom
                },
                duration: 2,
                autoStart: false,
                update(param){
                    camera.zoom = param.zoom;
                    camera.updateProjectionMatrix();
                }
            });

            /**
             * Enter Tunnel
             */
            var animEnterTunnel = animator.expoIn({
                destination: {
                    opacity: 0.8,
                    rotation: new THREE.Vector3(deg2rad(90), 0, 0),
                    position: new THREE.Vector3(0, 0, 0),
                    logo: new THREE.Vector3(0, 10, -2),
                },
                origin: ({
                    opacity: tunnel.material.opacity,
                    rotation: tunnel.rotation.toVector3(),
                    position: camera.position,
                    logo: logo.position,
                }),
                duration: 5,
                autoStart: false,
                start(){
                    tunnel.userData.init();

                    logo.userData.mouse.inverse = true;
                    particles.material = particles.userData.particleFrontMaterial

                },
                update(params){
                    tunnel.material.opacity = params.opacity * 3;
                    camera.rotation.setFromVector3(params.rotation);
                    camera.position.copy(params.position);

                    logo.position.copy(params.logo);
                    ren.position.copy(params.logo);

                    /**
                     * Enable movement on the way up
                     */
                    if (logo.userData.mouse.enabled === true) {
                        logo.position.z = params.logo.z + -mouse.screen.y * logo.userData.mouse.speed.z;
                        ren.position.z = params.logo.z + -mouse.screen.y * logo.userData.mouse.speed.z;
                    }

                },
                complete(){
                    animCameraZoomIn.init();
                }

            });

            /**
             * throw logo up
             */
            var animFadeParticles = animator.expoOut({
                destination: {opacity: 0.5},
                duration: 2,
                autoStart: false,
                update(param){
                    particles.material.opacity = param.opacity
                }
            });

            var animThrowLogoUp = animator.expoOut({
                destination: {
                    logo: {y: 10},
                    ren: {y: 10},
                    camera: {y: 10},
                },
                origin: ({
                    logo: logo.position,
                    ren: ren.position,
                    camera: camera.position,
                }),
                duration: 5,
                autoStart: false,
                start(){

                    animFadeParticles.init();
                    particles.userData.start = true;

                    /**
                     * Enable Mouse Movement
                     */
                    logo.userData.mouse.enabled = true;

                    /**
                     * Slide doom elements down
                     */
                    domLogo.style.top = '110%';
                    background.style.backgroundPositionY = '-110%';

                },
                update(params){

                    /**
                     * Enable movement on the way up
                     */
                    if (logo.userData.mouse.enabled === true) {
                        logo.position.y = params.logo.y + -mouse.screen.y * logo.userData.mouse.speed.y;
                        ren.position.y = params.ren.y + -mouse.screen.y * logo.userData.mouse.speed.y;
                    }

                    camera.position.setY(params.camera.y);
                },
                complete(){
                    animEnterTunnel.init()
                }
            });

            var animRenBackIn = animator.backOut({
                destination: new THREE.Vector3(0, 7, 0),
                origin: ren.position,
                duration: 0.2,
                autoStart: false,
                update(params){
                    ren.position.copy(params)
                },
                complete(){
                    animThrowLogoUp.init();
                }
            });

            /**
             * Rotate logo
             */
            animator.sineInOut({
                destination: {
                    rotation: deg2rad(360) * 4
                },
                origin: {
                    rotation: logo.rotation.y
                },
                duration: 2,
                delay: 0.5,
                update(params){
                    logo.rotation.y = params.rotation
                },
                complete(){
                    animRenBackIn.init()
                }
            });

            scene.add(particles, tunnel);

            return;

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

            var particles = elements.Particles,
                particlesPositions = particles.geometry.attributes.position,
                particlesVelocities = particles.userData.velocity;

            particles.position.y = camera.position.y;

            if (particles.userData.start === true)
                For(particlesPositions.count, function (i) {

                    if (particlesPositions.array[i * 3 + 1] < -80)
                        particlesPositions.array[i * 3 + 1] = 80;

                    particlesPositions.array[i * 3 + 1] -= particlesVelocities[i].y / 2;

                });

            particlesPositions.needsUpdate = true;

            var logo = elements.Logo,
                ren = elements.Ren;

            if (logo.userData.mouse.enabled === true && logo.userData.mouse.inverse === false) {

                logo.position.x = ren.position.x = mouse.screen.x * logo.userData.mouse.speed.x;
                logo.position.y = ren.position.y = -mouse.screen.y * logo.userData.mouse.speed.y + camera.position.y;

            }

            if (logo.userData.mouse.enabled === true && logo.userData.mouse.inverse === true) {

                logo.position.x = ren.position.x = mouse.screen.x * logo.userData.mouse.speed.x;
                logo.position.z = ren.position.z = -mouse.screen.y * logo.userData.mouse.speed.z;

            }

            /**
             * Tunnel
             */
            var tunnel = elements.Tunnel;

            if (tunnel.userData.timer !== null)
                tunnel.userData.update();

            return;

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