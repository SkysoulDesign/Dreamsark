module DreamsArk.Compositions {

    import For = DreamsArk.Helpers.For;
    import length = DreamsArk.Helpers.length;
    import deg2rad = DreamsArk.Helpers.deg2rad;

    export class Landing implements Composable {

        elements() {
            return ['Particles', 'Cube', 'Tunnel', 'Plexus'];
        }

        setup(scene, camera, elements) {

            //Camera.swing(new THREE.Vector3(0));
            var plexus = elements.Plexus,
                frustum = new THREE.Frustum();

            plexus.userData = {
                controls: null,
                init: function () {
                    this.controls = new THREE.TrackballControls(camera);
                }
            };

            plexus.userData.init();

            scene.add(elements.Particles, plexus);

            camera.position.z = 30

        }

        update(scene, camera, elements) {


            /**
             * Plexus
             */
            elements.Plexus.userData.controls.update();

            var particles = elements.Particles,
                positions = particles.geometry.getAttribute('position'),
                velocities = particles.userData.velocity;

            //particles.rotation.y -= 0.005;
            //particles.rotation.x += 0.005;

            positions.needsUpdate = true;

        }

    }

}