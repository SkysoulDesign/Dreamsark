module.exports = (function (e) {

    return e.loader = {
        /**
         * public property
         */
        progress: null,
        complete: false,
        on: {start: null, progress: null, load: null, error: null},

        /**
         * Modules
         */
        loader: null,

        init: function () {

            /**
             * Init Loader
             * @type {THREE.TextureLoader}
             */
            this.loader = new THREE.TextureLoader(e.module('manager', this.on));

        },

        /**
         * Load All Global Elements
         * @param elements
         * @param on
         */
        load: function (elements, on) {

            /**
             * if is an array of single objects, load recursively them all
             */
            if (e.helpers.isArray(elements)) {

                e.helpers.keys(elements, function (el) {
                    this.load(el);
                }, this);

                return;

            }

            /**
             * if an element is sent directly then initialize it
             */
            if (e.helpers.isFunction(elements.create)) {

                var name      = e.helpers.captalize(elements.name);
                var element   = {};
                element[name] = elements

                this.load(element);

                return e.helpers.extend(e.elements, element);

            }

            /**
             * only pass if it`s object and doesn't have create method so i assume it is an object of elements
             */
            e.helpers.keys(elements, function (el, name) {

                var maps     = {};
                var userData = {};

                /**
                 * if Maps is set then initialize it
                 */
                if (e.helpers.isFunction(el.maps)) {

                    e.helpers.keys(el.maps(), function (el, name) {
                        maps[name] = this.loader.load(el);
                    }, this);

                }

                /**
                 * Check if object has shared properties
                 */
                if (e.helpers.isFunction(el.share)) {
                    userData = el.share();
                }

                /**
                 * If the Object doesn't have create method means
                 * 1 - the object was already created so skip it
                 * 2 - the create function is missing so there is no way
                 * to create it
                 */
                if (!e.helpers.isFunction(el.create))
                    return;

                /**
                 * Create Object
                 * @type {e}
                 */
                var element      = el.create(e, maps, userData);
                element.name     = el.name;
                element.userData = e.helpers.extend(userData, element.userData);

                /**
                 * Override Element with its constructed version
                 * @type {e}
                 */
                elements[name] = element;

            }, this);
        }

    };

})(Engine);