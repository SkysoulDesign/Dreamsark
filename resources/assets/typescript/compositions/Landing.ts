module DreamsArk.Compositions {

    import For = DreamsArk.Helpers.For;
    import length = DreamsArk.Helpers.length;
    import deg2rad = DreamsArk.Helpers.deg2rad;
    import Mouse = DreamsArk.Modules.Mouse;

    export class Landing implements Composable {

        elements() {
            return ['Logo', 'Ren', 'Tunnel', 'Plexus'];
        }

        setup(scene, camera, elements) {

            var logo = <THREE.Object3D>elements.Logo,
                ren = <THREE.Object3D>elements.Ren;

            logo.scale.subScalar(0.97);
            logo.position.setY(7);

            ren.scale.subScalar(0.97);
            ren.position.setY(7);
            ren.position.setZ(0.2);

            scene.add(logo, ren);

            //Camera.swing(new THREE.Vector3(0));
            var plexus = elements.Plexus,
                frustum = new THREE.Frustum();

            plexus.userData = {
                controls: null,
                init: function () {
                    this.controls = new THREE.TrackballControls(camera);
                }
            };

            //plexus.userData.init();

            scene.add(plexus);

            camera.position.z = 30

        }

        update(scene, camera, elements) {

            var mouse = <Mouse>module('Mouse');

            /**
             * Plexus
             */
            //elements.Plexus.userData.controls.update();

            /**
             * camera
             */
            //camera.position.x = -mouse.screen.x * 0.02;
            //camera.position.y = mouse.screen.y * 0.02;
            //camera.lookAt(scene.position);

        }

    }

}