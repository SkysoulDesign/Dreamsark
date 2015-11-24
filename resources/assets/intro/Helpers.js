module.exports = function (e) {

    return e.helpers = {
        init: function () {

            for (var i = 0; i < arguments.length; i++) {

                /**
                 * Recursively Init All
                 */
                if (typeof arguments[i].init === 'undefined') {

                    var argument = arguments[i];

                    Object.keys(arguments[i]).forEach(function (key) {
                        this.init(argument[key]);
                    }, this);

                    return;

                }

                arguments[i].init();

                /**
                 * Configure if necessary
                 */
                if (typeof arguments[i].configure === "function") {
                    arguments[i].configure(arguments[i].instance);
                }

            }

        },

        set: function (object, closure) {
            closure.call(object, closure);
        },

        appendTo: function (element, domElement) {
            document.getElementById(element).appendChild(domElement)
        },

        timeout: function (time, closure) {
            setTimeout(function () {
                closure.call()
            }, time);
        },

        extend: function (obj, src) {
            Object.keys(src).forEach(function (key) {
                obj[key] = src[key];
            });
            return obj;
        },

        /**
         * Group objects
         * @returns {THREE.Group}
         */
        group: function () {

            var group = new THREE.Group();

            for (var i = 0; i < arguments.length; i++) {
                group.add(arguments[i]);
            }

            return group;

        },
        random: function (min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
    }

}(Engine);