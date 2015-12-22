var DreamsArk;
(function (DreamsArk) {
    var Modules;
    (function (Modules) {
        var Loader = (function () {
            function Loader() {
                var manager = module('Manager');
                /**
                 * Init Loader
                 * @type {THREE.TextureLoader}
                 */
                this.textureLoader = new exports.THREE.TextureLoader(manager);
                /**
                 * Init OBJ Loader
                 */
                this.objLoader = new exports.THREE.OBJLoader(manager);
            }
            Loader.prototype.configure = function () {
            };
            return Loader;
        })();
        Modules.Loader = Loader;
        var Manager = (function () {
            function Manager(on) {
                this.on = on;
                this.instance = new exports.THREE.LoadingManager();
            }
            Manager.prototype.configure = function () {
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
            };
            return Manager;
        })();
        Modules.Manager = Manager;
    })(Modules = DreamsArk.Modules || (DreamsArk.Modules = {}));
})(DreamsArk || (DreamsArk = {}));
//# sourceMappingURL=Loader.js.map