/// <reference path="Helpers.ts" />

/// <reference path="elements/Ball.ts" />
/// <reference path="elements/Galaxy.ts" />
/// <reference path="elements/Overlay1.ts" />
/// <reference path="elements/Overlay2.ts" />
/// <reference path="elements/Cube.ts" />

/// <reference path="modules/Browser.ts" />
/// <reference path="modules/Checker.ts" />
/// <reference path="modules/Loader.ts" />
/// <reference path="modules/Mouse.ts" />
/// <reference path="modules/Camera.ts" />
/// <reference path="modules/Scene.ts" />
/// <reference path="modules/Renderer.ts" />

/// <reference path="compositions/Loading.ts" />


module DreamsArk {

    import is = DreamsArk.Helpers.is;
    import init = DreamsArk.Helpers.init;
    import Mouse = DreamsArk.Modules.Mouse;
    import Loader = DreamsArk.Modules.Loader;
    import Renderer = THREE.Renderer;
    import Scene = THREE.Scene;
    import Camera = THREE.PerspectiveCamera;
    import Checker = DreamsArk.Modules.Checker;

    /**
     * Debug Mode
     * @type {boolean}
     */
    export var debug:boolean = false;

    export var elementsBag:{} = {};

    export var core:any = {
        active: {
            composition: null
        }
    };

    export class App {

        constructor() {

            /**
             * start Loading the basic scene
             */
            load();

            Mouse.click('#start', function () {

                start();

                return true;

            });

        }

    }

    export var start = function () {

        var loader = module('Loader').start();

        render();
    };

    export var load = function () {

        var composition = new Composition('Loading');

        render();

    };

    export var render = function () {

        requestAnimationFrame(render);

        var renderer = <Renderer>module('Renderer'),
            scene = <Scene>module('Scene'),
            camera = <Camera>module('Camera'),
            checker = <Checker>module('Checker');

        if (!is.Null(core.active.composition))
            if (core.active.composition.update)
                core.active.composition.update(scene, camera, core.active.composition.elementsBag)

        checker.update();

        renderer.render(scene, camera);

    };

    /**
     * Get Initializable and initialize it if is not initialized before
     * @param module
     * @returns {*}
     */
    export var module = function (module) {

        /**
         * Return Null if doesn't exist
         */
        if (is.Null(Modules[module]))
            return console.log('module ' + module + ' couldn\'t be found')

        /**
         * if Module is not initialized then init it
         */
        if (is.Null(Modules[module].instance))
            init([Modules[module]]);

        return <any>Modules[module].instance;

    };

    export var element = function (name) {

        if (is.Null(elementsBag[name])) {

            console.log('Element ' + name + ' doesn\'t exist or it wasn\'t loaded.');
            return;

        }

        return elementsBag[name];

    };

    export class Composition {

        constructor(public name:string) {

            if (is.Null(Compositions[name])) {
                console.log('Composition: ' + name + ' not found.');
                return;
            }

            var loader = new Loader,
                scene = module('Scene'),
                camera = module('Camera'),
                composition = new Compositions[name],
                ready = function (elements) {
                    composition.setup(scene, camera, elements);
                    /**  should merge the elements here */
                    composition.elementsBag = elements;
                    core.active.composition = composition;
                };

            if (!is.Null(composition.elements))
                loader.Load(composition.elements(), ready);

        }

    }

}

/**
 * Start App
 */
new DreamsArk.App();