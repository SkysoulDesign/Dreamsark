module DreamsArk.Compositions {

    import For = DreamsArk.Helpers.For;
    import length = DreamsArk.Helpers.length;

    export class Loading implements Composable {

        elements() {
            return ['Logo'];
        }

        setup(scene, camera, elements) {

            //Camera.swing(new THREE.Vector3(0));

            var logo = elements.Logo,
                animator = module('Animator');

            logo.scale.set(0)

            //animator.linearIn(logo.scale, function () {
            //
            //});

            scene.add(logo);

            camera.position.z = 30

        }

        update(scene, camera, elements) {


        }

    }

}