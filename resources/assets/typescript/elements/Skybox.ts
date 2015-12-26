module DreamsArk.Elements {

    import deg2rad = DreamsArk.Helpers.deg2rad;

    export class Skybox implements Loadable {

        public instance:any;

        maps():{} {
            return {
                skybox: 'lib/background-sphere.jpg'
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