module DreamsArk.Modules {

    export class Scene implements Initializable {

        public instance:THREE.Scene;

        constructor() {
            this.instance = new THREE.Scene();
        }

        configure():void {

        }

    }

}