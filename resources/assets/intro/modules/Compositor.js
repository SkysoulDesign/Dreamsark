module.exports = (function (e) {

    return e.compositor = {

        /**
         * public property
         */
        compositions: null,
        active: null,

        /**
         * Modules
         */
        compositor: null,

        init: function () {

            this.compositions = require('./../Compositions');
            this.order        = e.configs.compositions;
            this.compositor   = this;

            /**
             * Setup right after init so it will start the loading composition as default
             */
            this.setup();

        },

        setup: function (composition) {

            /**
             * Set the first composition if none is set
             */
            if (e.helpers.isNull(composition)) {
                return this.setup(this.compositions[this.order[0]]);
            }

            if (e.helpers.isFunction(composition)) {

                var scene    = e.module('scene'),
                    camera   = e.module('camera'),
                    elements = e.elements,

                    /**
                     * Initialize comp
                     */
                    comp     = composition(e, scene, camera, elements),
                    loader   = e.module('loader').class;

                /**
                 * Load comp dependencies
                 */
                loader.load(comp.load);

                return this.setup(comp);

            }

            /**
             * Loop on update until loader is complete then init the composition
             */
            e.checker.add(function () {

                var loader = e.module('loader').class;

                if (e.helpers.isObject(composition) && loader.complete) {

                    this.active = composition;
                    this.active.setup();

                    return true;

                }

                return false;

            }, this)

        },

        update: function () {

            if (!e.helpers.isNull(this.active) && e.helpers.isFunction(this.active.animation)) {
                this.active.animation();
            }

        }

    };

})(Engine);