module DreamsArk.Compositions {

    export class Loading implements Composable {

        elements() {
            return ['Overlay1', 'Overlay2'];
        }

        setup(scene, camera, elements) {

            Camera.swing(new THREE.Vector3(0));

            elements.Overlay2.position.z = -5

            scene.add(elements.Overlay1, elements.Overlay2);
            camera.position.z = 20

        }

        update(scene, camera, elements) {

        }

    }

}