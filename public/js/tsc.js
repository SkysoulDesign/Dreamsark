var DreamsArk;
(function (DreamsArk) {
    var Helpers;
    (function (Helpers) {
        Helpers.init = function (items) {
            if (items === void 0) { items = []; }
            /**
             * Init All items in a row
             */
            Helpers.each(items, function (item) {
                var component = new item;
                component.configure();
                item.instance = component.instance;
            });
        };
        Helpers.each = function (items, callback, context) {
            if (items === void 0) { items = []; }
            if (context === void 0) { context = DreamsArk; }
            if (is.Array(items))
                items.forEach(callback.bind(context));
            if (is.Object(items))
                Object.keys(items).forEach(function (name) {
                    callback.call(context, items[name], name);
                });
        };
        /**
         * Dom Utils
         */
        Helpers.appendTo = function (element, domElement) {
            document.querySelector(element).appendChild(domElement);
        };
        /**
         * Checker if obj is X type
         */
        var is = (function () {
            function is() {
            }
            is.Array = function (item) {
                return Array.isArray(item);
            };
            is.Object = function (item) {
                return (typeof item === "object" && !Array.isArray(item) && item !== null);
            };
            is.Null = function (item) {
                return (item === null || item === undefined || item === 0 || item === '0');
            };
            is.Function = function (item) {
                return !!(item && item.constructor && item.call && item.apply);
            };
            return is;
        })();
        Helpers.is = is;
    })(Helpers = DreamsArk.Helpers || (DreamsArk.Helpers = {}));
})(DreamsArk || (DreamsArk = {}));
var DreamsArk;
(function (DreamsArk) {
    var Modules;
    (function (Modules) {
        var Browser = (function () {
            function Browser() {
                this.instance = this;
                this.innerWidth = window.innerWidth;
                this.innerHeight = window.innerHeight;
                this.devicePixelRatio = window.devicePixelRatio;
            }
            Browser.prototype.configure = function () {
            };
            return Browser;
        })();
        Modules.Browser = Browser;
    })(Modules = DreamsArk.Modules || (DreamsArk.Modules = {}));
})(DreamsArk || (DreamsArk = {}));
var DreamsArk;
(function (DreamsArk) {
    var Modules;
    (function (Modules) {
        var Camera = (function () {
            function Camera() {
                this.instance = new THREE.PerspectiveCamera();
            }
            Camera.prototype.configure = function () {
                this.instance.fov = 75;
                this.instance.aspect = window.innerWidth / window.innerHeight;
                this.instance.near = 0.1;
                this.instance.far = 10000;
            };
            return Camera;
        })();
        Modules.Camera = Camera;
    })(Modules = DreamsArk.Modules || (DreamsArk.Modules = {}));
})(DreamsArk || (DreamsArk = {}));
var DreamsArk;
(function (DreamsArk) {
    var Modules;
    (function (Modules) {
        var Scene = (function () {
            function Scene() {
                this.instance = new THREE.Scene();
            }
            Scene.prototype.configure = function () {
            };
            return Scene;
        })();
        Modules.Scene = Scene;
    })(Modules = DreamsArk.Modules || (DreamsArk.Modules = {}));
})(DreamsArk || (DreamsArk = {}));
var DreamsArk;
(function (DreamsArk) {
    var Modules;
    (function (Modules) {
        var Renderer = (function () {
            function Renderer() {
                this.instance = new THREE.WebGLRenderer();
            }
            Renderer.prototype.configure = function () {
                var domElement = this.instance.domElement;
                domElement.style.position = 'absolute';
                domElement.style.zIndex = '5';
                DreamsArk.Helpers.appendTo('#container', domElement);
                /**
                 * Get Global Browser settings
                 */
                var browser = DreamsArk.module('Browser');
                //this.setClearColor(scene.a.fog.color);
                this.instance.setPixelRatio(browser.devicePixelRatio);
                this.instance.setSize(browser.innerWidth, browser.innerHeight);
            };
            return Renderer;
        })();
        Modules.Renderer = Renderer;
    })(Modules = DreamsArk.Modules || (DreamsArk.Modules = {}));
})(DreamsArk || (DreamsArk = {}));
/// <reference path="Helpers.ts" />
/// <reference path="modules/Browser.ts" />
/// <reference path="modules/Camera.ts" />
/// <reference path="modules/Scene.ts" />
/// <reference path="modules/Renderer.ts" />
var DreamsArk;
(function (DreamsArk) {
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
    var Start = (function () {
        function Start() {
            DreamsArk.Render();
        }
        return Start;
    })();
    DreamsArk.Start = Start;
    DreamsArk.Render = function () {
        requestAnimationFrame(DreamsArk.Render);
        var renderer = DreamsArk.module('Renderer'), scene = DreamsArk.module('Scene'), camera = DreamsArk.module('Camera');
        renderer.render(scene, camera);
    };
    /**
     * Get Initializable and initialize it if is not initialized before
     * @param module
     * @returns {*}
     */
    DreamsArk.module = function (module) {
        /**
         * Return Null if doesn't exist
         */
        if (DreamsArk.Helpers.is.Null(DreamsArk.Modules[module]))
            return console.log('module ' + module + ' couldn\'t be found');
        /**
         * if Module is not initialized then init it
         */
        if (DreamsArk.Helpers.is.Null(DreamsArk.Modules[module].instance))
            DreamsArk.Helpers.init([DreamsArk.Modules[module]]);
        return DreamsArk.Modules[module].instance;
    };
})(DreamsArk || (DreamsArk = {}));
/**
 * Start App
 */
new DreamsArk.App();
new DreamsArk.Start();
var DreamsArk;
(function (DreamsArk) {
    var Modules;
    (function (Modules) {
        var Loader = (function () {
            function Loader() {
                var manager = DreamsArk.module('Manager');
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
            Loader.prototype.configure = function () {
            };
            return Loader;
        })();
        Modules.Loader = Loader;
        var Manager = (function () {
            function Manager(on) {
                this.on = on;
                this.instance = new THREE.LoadingManager();
            }
            Manager.prototype.configure = function () {
                this.instance.onStart = function (item, loaded, total) {
                    if (DreamsArk.Helpers.is.Function(this.on.start))
                        this.on.start(item, loaded, total);
                };
                this.instance.onProgress = function (item, loaded, total) {
                    var loader = DreamsArk.module('Loader');
                    var progress = loader.progress = (loaded * 100) / total;
                    if (DreamsArk.Helpers.is.Function(this.on.progress))
                        this.on.progress(Math.round(progress), item, loaded, total);
                };
                this.instance.onLoad = function () {
                    var loader = DreamsArk.module('Loader');
                    loader.complete = true;
                    if (DreamsArk.Helpers.is.Function(this.on.load))
                        this.on.load();
                };
                this.instance.onError = function (item) {
                    console.log('item: ' + item + " not loaded");
                    if (DreamsArk.Helpers.is.Function(this.on.error))
                        this.on.error(item);
                };
            };
            return Manager;
        })();
        Modules.Manager = Manager;
    })(Modules = DreamsArk.Modules || (DreamsArk.Modules = {}));
})(DreamsArk || (DreamsArk = {}));
//# sourceMappingURL=tsc.js.map