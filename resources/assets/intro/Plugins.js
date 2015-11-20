module.exports = (function (e) {

    // Require all of the scripts in the elements directory
    var plugins = require('bulk-require')(__dirname, ['plugins/**/*.js']).plugins;

    return e.plugins = plugins;

    return e.plugins = {

        init: function (components) {

            Object.keys(plugins).map(function (plugin) {
                plugins[plugin].init(components);
            });

            return plugins;

        }

    }

})(Engine);