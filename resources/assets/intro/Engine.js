module.exports = (function (e) {

    /**
     * Init Core
     */
    var helpers      = require('./Helpers'),
        manager      = require('./modules/Manager'),
        elements     = require('./Elements'),
        compositions = require('./Compositions'),
        compositor   = require('./Compositor'),
        camera       = require('./modules/Camera'),
        scene        = require('./modules/Scene'),
        renderer     = require('./modules/Renderer'),
        plugins      = require('./Plugins'),
        loader       = require('./Loader');

    /**
     * Init Stuff
     */
    helpers.init(loader, scene, camera, compositor);

    /**
     * Set Renderer Sizes
     */
    helpers.set(renderer, function () {
        this.setClearColor(scene.a.fog.color);
        this.setPixelRatio(window.devicePixelRatio);
        this.setSize(window.innerWidth, window.innerHeight);
    });

    /**
     * Append to container
     */
    helpers.appendTo('container', renderer.domElement);

    var render = {
        render: function () {

            requestAnimationFrame(render.render);

            /**
             * Return if it`s loading
             */
            if (loader.loading) {
                console.log('loading');
            }

            /**
             * Render Composition
             */
            compositor.animate();

            /**
             * Render
             */
            renderer.render(scene.a, camera.a);

        }
    };

    return render;

})(Engine);