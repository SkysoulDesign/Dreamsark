module.exports = (function (e, c) {

    var renderer = new THREE.WebGLRenderer(c.renderer);

    /**
     * Append Renderer to Engine
     * @type {THREE.WebGLRenderer}
     */
    return e.renderer = renderer;

    //return {
    //    get: function () {
    //        renderer.scope = this;
    //        return renderer;
    //    },
    //    set: function ($closure) {
    //        $closure.call(renderer);
    //    },
    //    appendTo: function ($element) {
    //        document.getElementById($element).appendChild(renderer.domElement)
    //    }
    //};

})(Engine, Configs);