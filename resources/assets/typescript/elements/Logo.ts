module DreamsArk.Elements {

    export class Logo implements Loadable {

        public instance:any;

        objs():{} {
            return {
                logo: 'models/logo.obj',
            }
        }

        create(maps, objs, data) {

            var logo = objs.logo;
            logo.material = new THREE.MeshBasicMaterial({color: 0x00ff00, wireframe: true});

            return logo;

        }

    }

}