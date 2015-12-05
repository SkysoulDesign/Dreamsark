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
            return (item === null || item === undefined);
        },

        keys: function (elements, callback, bind) {

            if (this.isArray(elements))
                elements.forEach(function (el) {
                    callback.call(bind || Engine, el);
                });

            if (this.isObject(elements))
                Object.keys(elements).forEach(function (name) {
                    callback.call(bind || Engine, elements[name], name);
                });
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
        }
    }

})();