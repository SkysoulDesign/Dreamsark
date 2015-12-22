var DreamsArk;
(function (DreamsArk) {
    var Components;
    (function (Components) {
        var Scene = (function () {
            function Scene() {
                console.log('Im Scene');
            }
            return Scene;
        })();
        Components.Scene = Scene;
        var Camera = (function () {
            function Camera() {
                console.log('Im Camera');
            }
            return Camera;
        })();
        Components.Camera = Camera;
        var Renderer = (function () {
            function Renderer() {
                console.log('Im Renderer');
            }
            return Renderer;
        })();
        Components.Renderer = Renderer;
    })(Components = DreamsArk.Components || (DreamsArk.Components = {}));
})(DreamsArk = exports.DreamsArk || (exports.DreamsArk = {}));
//# sourceMappingURL=Components.js.map