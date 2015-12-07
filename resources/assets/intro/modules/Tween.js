module.exports = (function (e) {

    /**
     * Append Camera to Engine
     */
    return e.tween = {

        tween: null,

        init: function () {
            this.tween = this;
        },

        create: function (obj, duration, callback, context) {

            /**
             * todo find a better way to the time... maybe get the delta from the renderer
             * @type {number}
             */
            var time        = +new Date(),
                toEasyLater = {};

            var checker = e.module('checker').class;

            checker.add(function () {

                var elapsed_time = (+new Date()) - time;

                if (elapsed_time < duration) {

                    var progress = elapsed_time / duration;

                    toEasyLater = e.helpers.map(obj, function (value, key) {
                        return Easie.quintInOut(progress, 0, value, 1);
                    });

                    /**
                     * Call the Call Back
                     */
                    callback.call(context || e, toEasyLater);

                } else {

                    /**
                     * Destroy Checker
                     */
                    return true;

                }

            }, this);

        },

        map: function (obj, progress) {

            var toEasyLater = {};

            /**
             * Loop on every property and set them accordingly
             */
            e.helpers.keys(obj, function (el, index) {

                /**
                 * if it's an object, map again
                 */
                if (e.helpers.isObject(el)) {
                    return toEasyLater[index] = this.map(el, progress);
                } else {
                    toEasyLater[index] = Easie.quintInOut(progress, 0, el, 1)
                }


            }, this);

            return toEasyLater;

        },

        add: function (target, duration, vars) {
            return new TweenLite(target, duration, vars);
        }

    };

})(Engine);