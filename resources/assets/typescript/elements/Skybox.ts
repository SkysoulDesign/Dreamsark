module DreamsArk.Elements {

    export class Skybox implements Loadable {

        public instance:THREE.Object3D;

        maps() {
            return {
                skybox: 'lib/background-sphere-temp.jpg'
            }
        }

        create(maps, objs, data) {

            var geometry = new THREE.SphereGeometry(500, 50, 50);
            geometry.scale(-1, 1, 1);
            var material = new THREE.MeshBasicMaterial({map: maps.skybox, transparent: true, opacity: 0});
            return new THREE.Mesh(geometry, material);

        }

    }

}