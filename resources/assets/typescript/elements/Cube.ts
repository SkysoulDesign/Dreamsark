module DreamsArk.Elements {

    export class Cube implements Loadable {

        public instance:any;

        maps():{} {
            return {
                sparks1: 'lib/cover-hunger.png',
                sparks2: 'lib/cover-hunger.png',
                sparks3: 'lib/cover-hunger.png',
                sparks4: 'lib/cover-hunger.png',
                sparks5: 'lib/cover-hunger.png',
                sparks6: 'lib/cover-hunger.png',
                sparks7: 'lib/cover-hunger.png',
                sparks8: 'lib/cover-hunger.png',
                sparks9: 'lib/cover-hunger.png',
                sparks10: 'lib/cover-hunger.png'
            }
        }

        objs():{} {
            return {
                logo1: 'models/ship.obj',
                logo2: 'models/ship.obj',
                logo3: 'models/ship.obj',
                logo4: 'models/ship.obj',
                logo5: 'models/ship.obj',
                logo6: 'models/ship.obj',
                logo7: 'models/ship.obj',
            }
        }

        create(maps, objs):{} {

            var geometry = new THREE.BoxGeometry(1, 1, 1);
            var material = new THREE.MeshBasicMaterial({color: 0x00ff00});

            return new THREE.Mesh(geometry, material);

        }

    }

}