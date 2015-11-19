module.exports = (function () {

    // Require all of the scripts in the elements directory
    var plugins = require('bulk-require')(__dirname, ['plugins/**/*.js']).plugins;

    return {
        init: function (camera, scene, renderer) {

            var components = {
                camera: camera, scene: scene, renderer: renderer
            };

            Object.keys(plugins).map(function (plugin) {
                plugins[plugin].init(components);
            });

            return plugins;

        }
    }

})();