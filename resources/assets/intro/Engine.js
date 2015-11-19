module.exports = (function () {

    /**
     * Init
     */
    var camera = require('./modules/Camera');
    var scene = require('./modules/Scene');
    var renderer = require('./modules/Renderer');
    var elements = require('./Elements');

    /**
     * Plugins
     */
    var controls = require('./plugins/TrackBallControls')(camera);

    /**
     * Append to body
     */
    document.body.appendChild(renderer.domElement);

    var cube = elements('Cube').scene(scene).get();

    elements('Skybox').scene(scene);

    //    scene.add(cube);
    camera.position.z = 5;

    var render = {
        render:function () {
            requestAnimationFrame(render.render);

            cube.rotation.x += 0.1;
            cube.rotation.y += 0.1;

            /**
             * Update Controls
             */
            controls.update();

            renderer.render(scene, camera);
        }
    };

    return render;

})();