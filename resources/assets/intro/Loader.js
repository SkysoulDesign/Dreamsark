module.exports = (function (e, c) {

    return e.loader = {

        loading: false,

        init: function () {

            /**
             * Load Global Items
             */
            this.load(c.elements['global']);

        },

        load: function (elements) {
            this.loading = true;
            elements.forEach(function (el) {
                e.elements[el.name]      = el.create(e);
                e.elements[el.name].name = el.name;
            });
            this.loading = false;
        },

        compositionLoader: function (name) {
            this.load(c.elements[name]);
        },

        /**
         * Remove Object from Scene and Dispose it
         */
        destruct: function () {
            for (var i = 0; i < arguments.length; i++) {
                e.scene.a.remove(arguments[i]);
                delete e.elements[arguments[i].name];
                this.dispose(arguments[i]);
            }
        },

        /**
         * Dispose the object from memory
         */
        dispose: function (object) {
            object.geometry.dispose();
            object.material.dispose();
        }

    };

})(Engine, Configs);