/// <reference path="Helpers.ts" />
/// <reference path="compositions/Loading.ts" />
/// <reference path="modules/Browser.ts" />
/// <reference path="modules/Loader.ts" />
/// <reference path="modules/Mouse.ts" />
/// <reference path="modules/Camera.ts" />
/// <reference path="modules/Scene.ts" />
/// <reference path="modules/Renderer.ts" />
var DreamsArk;
(function (DreamsArk) {
    var Mouse = DreamsArk.Modules.Mouse;
    /**
     * Debug Mode
     * @type {boolean}
     */
    DreamsArk.debug = false;
    var App = (function () {
        function App() {
        }
        return App;
    })();
    DreamsArk.App = App;
    [];
    {
        /**
         * start Loading the basic scene
         */
        exports.load();
        Mouse.click('#start', function () {
            exports.start();
            return true;
        });
    }
})(DreamsArk || (DreamsArk = {}));
exports.start = function () {
    var loader = exports.module('Loader').start();
    exports.render();
};
exports.load = function () {
    var composition = new Composition('Loading');
    exports.render();
};
exports.render = function () {
    requestAnimationFrame(exports.render);
    var renderer = exports.module('Renderer'), scene = exports.module('Scene'), camera = exports.module('Camera');
    renderer.render(scene, camera);
};
/**
 * Get Initializable and initialize it if is not initialized before
 * @param module
 * @returns {*}
 */
exports.module = function (module) {
    /**
     * Return Null if doesn't exist
     */
    if (Helpers.is.Null(Modules[module]))
        return console.log('module ' + module + ' couldn\'t be found');
    /**
     * if Module is not initialized then init it
     */
    if (Helpers.is.Null(Modules[module].instance))
        Helpers.init([Modules[module]]);
    return Modules[module].instance;
};
var Composition = (function () {
    function Composition(name) {
        this.name = name;
        console.log(Compositions[name]);
        if (is.Null(Compositions[name])) {
            console.log('Composition: ' + name + ' not found.');
            return;
        }
        var loader = exports.module('Loader'), composition = new Compositions[name], elements = null;
        if (!is.Null(composition.elements)) {
            elements = loader.Load(composition.elements());
        }
        console.log(elements);
        //composition.setup(elements);
    }
    return Composition;
})();
exports.Composition = Composition;
/**
 * Start App
 */
new DreamsArk.App();
//# sourceMappingURL=App.js.map