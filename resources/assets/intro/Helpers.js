module.exports = (function () {

    return {

        init: function () {

            for (var i = 0; i < arguments.length; i++) {

                /**
                 * if no arguments, break it
                 */
                if (this.isNull(arguments[i]))
                    return;

                /**
                 * Recursively Init All
                 */
                if (!this.isFunction(arguments[i].init)) {

                    this.keys(arguments[i], function (el) {
                        this.init(el);
                    });

                    return;

                }

                /**
                 * Init if it has Init set
                 */
                if (this.isFunction(arguments[i].init))
                    arguments[i].init();

                /**
                 * Configure if necessary
                 */
                if (this.isFunction(arguments[i].configure))
                    arguments[i].configure(arguments[i].instance);

            }

        },

        isObject: function (item) {
            return (typeof item === "object" && !Array.isArray(item) && item !== null);
        },

        isFunction: function (item) {
            return !!(item && item.constructor && item.call && item.apply);
        },

        isArray: function (item) {
            return Array.isArray(item);
        },

        isNull: function (item) {
            return (item === null || item === undefined || item === 0 || item === '0');
        },

        keys: function (elements, callback, context) {

            if (this.isArray(elements))
                elements.forEach(function (el, index) {
                    callback.call(context || Engine, el, index);
                });

            if (this.isObject(elements))
                Object.keys(elements).forEach(function (name) {
                    callback.call(context || Engine, elements[name], name);
                });
        },

        map: function (obj, callback, context) {

            var instance = {};

            /**
             * Loop on every property and set them accordingly
             */
            this.keys(obj, function (el, index) {

                /**
                 * if it's an object, map again
                 */
                if (this.isObject(el)) {

                    return instance[index] = this.map(el, callback, context);

                } else {

                    /**
                     * call Callback
                     */
                    instance[index] = callback.call(context || Engine, el, index);

                }

            }, this);

            return instance;

        },

        for: function (max, callback, context) {
            for (var i = 0; i < max; i++)
                callback.call(context || Engine, i);
        },

        extend: function (obj, src) {

            this.keys(src, function (el, name) {
                obj[name] = el;
            });

            return obj;
        },

        set: function (object, closure) {
            closure.call(object, closure);
        },

        appendTo: function (element, domElement) {
            document.querySelector(element).appendChild(domElement);
        },

        captalize: function (string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },

        length: function (item) {

            if (this.isArray(item))
                return item.length;

            if (this.isObject(item)) {

                var length = 0;

                this.keys(item, function () {
                    length++
                });

                return length;

            }

        },

        timer: function (time, callback) {
            var timer = setInterval(callback, time * 1000);
        }
    }

})();