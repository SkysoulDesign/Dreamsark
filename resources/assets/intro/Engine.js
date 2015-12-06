module.exports = (function () {

    return {

        /**
         * Helpers
         */
        helpers: require('./Helpers'),
        configs: require('./Configs'),
        plugins: require('./Plugins'),

        /**
         * Public Property
         */

        /**
         * Modules
         */
        loader: null,
        manager: null,
        elements: null,
        compositor: null,
        renderer: null,
        scene: null,
        camera: null,
        mouse: null,
        checker: null,
        events: null,

        init: function () {

            var helpers = this.helpers;

            /**
             * Init Modules
             */
            require('./Modules');
            require('./Elements');

            helpers.init(
                this.loader,
                this.compositor
            );

            /**
             * Start Rendering
             */
            this.render();

            return this;

        },

        start: function (e) {

            this.loader.on.start = function () {
                document.querySelector('.body').style.display = 'none';
            };

            this.loader.on.progress = function () {
                console.log('loading');
            };

            this.loader.on.load = function () {

                console.log('everything finished loading');
                //var scene    = e.module('scene'),
                //    elements = e.module('elements');

                //scene.add(elements.Dreamsark);

            };

            this.loader.on.error = function () {

            };

            /**
             * Init Modules
             */
            this.loader.load(this.elements);

            /**
             * Init After Click
             */
            //this.helpers.init(
            //
            //);


        },

        /**
         * Get Modules and initialize it if is not initialized before
         * @param module
         * @param params
         * @returns {*}
         */
        module: function (module, params) {

            /**
             * if Module is not initialized then init it
             */
            if (this.helpers.isNull(this[module][module])) {
                this[module].init.call(this[module], params);

                /**
                 * Configure if is function
                 */
                if (this.helpers.isFunction(this[module].configure))
                    this[module].configure.call(this[module][module], this.configs[module], this[module]);

            }

            return this[module][module];

        },

        render: function () {

            /**
             * Init Modules on Render Time
             */
            var renderer   = this.module('renderer'),
                scene      = this.module('scene'),
                camera     = this.module('camera'),
                compositor = this.module('compositor'),
                checker    = this.module('checker');

            var render = {
                render: function () {
                    requestAnimationFrame(render.render);

                    /**
                     * Update compositor
                     */
                    compositor.update();

                    /**
                     * Update Checker
                     */
                    checker.update();

                    renderer.render(scene, camera);
                }
            };

            render.render();

        }

    }

})();