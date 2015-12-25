module DreamsArk.Compositions {

    import For = DreamsArk.Helpers.For;
    import length = DreamsArk.Helpers.length;

    export class Landing implements Composable {

        elements() {
            return ['Particles', 'Cube'];
        }

        setup(scene, camera, elements) {

            //Camera.swing(new THREE.Vector3(0));

            scene.add(elements.Particles);

            camera.position.z = 30

        }

        update(scene, camera, elements) {

            var particles = elements.Particles,
                positions = particles.geometry.getAttribute('position'),
                velocities = particles.userData.velocity;

            particles.rotation.y -= 0.005;
            particles.rotation.x += 0.005;
            //particles.rotation.z += 0.002;

            For(positions.count, function (i) {

                //positions.array[i * 3] += velocities[i].x;
                //positions.array[i * 3 + 1] += velocities[i].y;
                //positions.array[i * 3 + 2] += velocities[i].z;

            });

            positions.needsUpdate = true;

        }

    }

}