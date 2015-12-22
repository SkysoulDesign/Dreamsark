module DreamsArk.Modules {

    export class Camera implements Initializable {

        public instance:THREE.PerspectiveCamera;

        constructor() {
            this.instance = new THREE.PerspectiveCamera()
        }

        configure():void {

            this.instance.fov = 75;
            this.instance.aspect = window.innerWidth / window.innerHeight;
            this.instance.near = 0.1;
            this.instance.far = 10000;
        }

    }

}