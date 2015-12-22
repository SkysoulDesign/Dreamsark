/// <reference path="Helpers.ts" />

/// <reference path="modules/Browser.ts" />
/// <reference path="modules/Camera.ts" />
/// <reference path="modules/Scene.ts" />
/// <reference path="modules/Renderer.ts" />

module DreamsArk {

    /**
     * Debug Mode
     * @type {boolean}
     */
    export var debug:boolean = false;

    export class App {

        constructor() {



        }

    }

    export class Start {

        constructor() {
            Render();
        }

    }

    export var Render = function () {

        requestAnimationFrame(Render);

        var renderer = module('Renderer'),
            scene = module('Scene'),
            camera = module('Camera');

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
        if (Helpers.is.Null(Modules[module]))
            return console.log('module ' + module + ' couldn\'t be found')

        /**
         * if Module is not initialized then init it
         */
        if (Helpers.is.Null(Modules[module].instance))
            Helpers.init([Modules[module]]);

        return Modules[module].instance;

    }

}

/**
 * Start App
 */
new DreamsArk.App();

new DreamsArk.Start();