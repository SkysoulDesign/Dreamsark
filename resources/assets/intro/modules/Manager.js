module.exports = (function (e, c) {

    /**
     * Append Renderer to Engine
     * @type {THREE.LoadingManager}
     */
    var manager = new THREE.LoadingManager();

    manager.onProgress = function (item, loaded, total) {
        console.log(item, loaded, total);
    };

    return e.manager = manager;

})(Engine, Configs);