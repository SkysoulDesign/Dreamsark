module DreamsArk.Components {

    export class Scene implements Initializable {

        public instance:THREE.Scene;

        constructor() {
            this.instance = new THREE.Scene();
        }

        configure():void {

        }

    }

    export class Camera implements Initializable {

        public instance:THREE.Camera

        constructor() {
            this.instance = new THREE.Camera()
        }

        configure():void {

        }

    }

    export class Renderer implements Initializable {

        public instance:THREE.WebGLRenderer;

        constructor() {
            this.instance = new THREE.WebGLRenderer();
        }

        configure():void {

        }

    }

}