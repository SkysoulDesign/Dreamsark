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

            this.setup();

        },

        setup: function (composition) {

            /**
             * Set the first composition if is not set
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
                    comp     = composition(e, scene, camera, elements);

                /**
                 * Load comp dependencies
                 */
                e.loader.load(comp.load);

                return this.setup(comp);

            }

            /**
             * Loop on update until loader is complete then init the composition
             */
            e.checker.add(function () {

                if (e.helpers.isObject(composition) && e.loader.complete) {

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