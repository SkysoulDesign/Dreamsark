module.exports = (function () {

    /**
     * Init
     */
    var camera = require('./modules/Camera').get(),
        scene = require('./modules/Scene').get(),
        renderer = require('./modules/Renderer').get(),
        elements = require('./Elements'),
        plugins = require('./Plugins').init(camera, scene, renderer);

    /**
     * Set Renderer Sizes
     */
    renderer.scope.set(function () {
        this.setClearColor(scene.fog.color);
        this.setPixelRatio(window.devicePixelRatio);
        this.setSize(window.innerWidth, window.innerHeight);
    });

    /**
     * Append to container
     */
    renderer.scope.appendTo('container');

    /**
     * Controls
     */
    var controls = plugins.TrackballControls.get();

    /**
     * Objects
     */
    var cube = elements('Cube').get(),
        skybox = elements('Skybox').get();

    /**
     * Scene Settings
     */
    scene.scope.set(function () {
        this.add(cube, skybox)
    });

    /**
     * Camera Settings
     */
    camera.scope.set(function () {
        this.position.z = 5;
    });

    var render = {
        render: function () {
            requestAnimationFrame(render.render);

            /**
             * Update Controls
             */
            controls.update();

            renderer.render(scene, camera);
        }
    };

    return render;

})();