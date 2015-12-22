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
                item.instance = (new item).instance;
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
    var Engine;
    (function (Engine) {
        var init = (function () {
            function init() {
                console.log('im engine');
            }
            return init;
        })();
        Engine.init = init;
    })(Engine = DreamsArk.Engine || (DreamsArk.Engine = {}));
})(DreamsArk || (DreamsArk = {}));
var DreamsArk;
(function (DreamsArk) {
    var Components;
    (function (Components) {
        var Scene = (function () {
            function Scene() {
                this.instance = new THREE.Scene();
            }
            Scene.prototype.configure = function () {
            };
            return Scene;
        })();
        Components.Scene = Scene;
        var Camera = (function () {
            function Camera() {
                this.instance = new THREE.Camera();
            }
            Camera.prototype.configure = function () {
            };
            return Camera;
        })();
        Components.Camera = Camera;
        var Renderer = (function () {
            function Renderer() {
                this.instance = new THREE.WebGLRenderer();
            }
            Renderer.prototype.configure = function () {
            };
            return Renderer;
        })();
        Components.Renderer = Renderer;
    })(Components = DreamsArk.Components || (DreamsArk.Components = {}));
})(DreamsArk || (DreamsArk = {}));
/// <reference path="Helpers.ts" />
/// <reference path="Engine.ts" />
/// <reference path="Components.ts" />
var DreamsArk;
(function (DreamsArk) {
    var App = (function () {
        function App() {
            var helpers = DreamsArk.Helpers.init(DreamsArk.Components);
        }
        return App;
    })();
    DreamsArk.App = App;
})(DreamsArk || (DreamsArk = {}));
//# sourceMappingURL=tsc.js.map