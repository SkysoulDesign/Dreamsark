module.exports = (function (e) {

    return e.compositor = {

        active: null,
        comp:   0,

        init: function () {

            var compName = Object.keys(e.compositions)[this.comp];

            /**
             * Load Assets
             */
            e.loader.compositionLoader(compName);

            this.active = e.compositions[compName];
            this.active.setup(e.elements);

        },

        animate: function () {
            this.active.animation(e.elements);
        },

        next: function () {
            this.comp++;
            this.init();
        },

        previous: function () {
            this.comp--;
            this.init();
        }

    }

})(Engine);