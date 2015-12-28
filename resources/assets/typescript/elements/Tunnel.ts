module DreamsArk.Elements {

    import deg2rad = DreamsArk.Helpers.deg2rad;

    export class Tunnel implements Loadable {

        public instance:THREE.Object3D;

        maps():{} {
            return {
                wave: 'assets/001_electric.jpg'
            }
        }

        create(maps, objs, data) {

            var texture = maps.wave;

            texture.wrapT = texture.wrapS = THREE.RepeatWrapping;
            texture.repeat.set(1, 2);

            // Tunnel Mesh
            return new THREE.Mesh(
                new THREE.CylinderGeometry(50, 50, 1024, 16, 32, true),
                new THREE.MeshBasicMaterial({
                    color: 0x2222ff,
                    //ambient: data.innerColor,
                    transparent: true,
                    alphaMap: texture,
                    //shininess: 0,
                    side: THREE.BackSide,
                    opacity: 0

                })
            );

        }

    }

}