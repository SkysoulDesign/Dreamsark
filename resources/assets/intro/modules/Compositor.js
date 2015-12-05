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

            this.compositions = require('./../Compositions')
            this.order        = e.configs.compositions;
            this.compositor   = this;

            /**
             * initiate the first comp
             */
            this.setup();

        },

        setup: function (composition) {

            /**
             * Set the first composition if is not set
             */
            if (composition === undefined) {
                return this.setup(this.compositions[this.order[0]]);
            }

            var scene    = e.module('scene'),
                camera   = e.module('camera'),
                elements = e.elements;

            this.active = composition(e, scene, camera, elements);
            this.active.setup();
        },

        update: function () {

            if (e.helpers.isFunction(this.active.animation))
                this.active.animation();

        }

    };

})(Engine);