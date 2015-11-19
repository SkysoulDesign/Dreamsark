module.exports = (function () {

    var renderer = new THREE.WebGLRenderer(Configs.renderer);

    return {
        get: function () {
            renderer.scope = this;
            return renderer;
        },
        set: function ($closure) {
            $closure.call(renderer);
        },
        appendTo: function ($element) {
            document.getElementById($element).appendChild(renderer.domElement)
        }
    };

})();