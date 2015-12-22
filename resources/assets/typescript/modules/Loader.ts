declare module THREE {
    export var OBJLoader:any;
}

module DreamsArk.Modules {

    export class Loader implements Initializable {

        public instance:any;

        public progress:number;
        public complete:boolean;

        public mananger:THREE.LoadingManager;

        public objLoader;
        public textureLoader;


        constructor() {

            var manager = module('Manager');

            /**
             * Init Loader
             * @type {THREE.TextureLoader}
             */
            this.textureLoader = new THREE.TextureLoader(manager);


            /**
             * Init OBJ Loader
             */
            this.objLoader = new THREE.OBJLoader(manager);

        }


        configure():void {
        }

    }

    export class Manager implements Initializable {

        public instance:any;

        constructor(public on:{():void}) {
            this.instance = new THREE.LoadingManager();
        }

        configure():void {

            this.instance.onStart = function (item, loaded, total) {
                if (Helpers.is.Function(this.on.start))
                    this.on.start(item, loaded, total);
            };

            this.instance.onProgress = function (item, loaded, total) {

                var loader = module('Loader');

                var progress = loader.progress = (loaded * 100) / total;

                if (Helpers.is.Function(this.on.progress))
                    this.on.progress(Math.round(progress), item, loaded, total);
            };

            this.instance.onLoad = function () {

                var loader = module('Loader');

                loader.complete = true;

                if (Helpers.is.Function(this.on.load))
                    this.on.load();

            };

            this.instance.onError = function (item) {
                console.log('item: ' + item + " not loaded");
                if (Helpers.is.Function(this.on.error))
                    this.on.error(item);
            };

        }

    }

}

