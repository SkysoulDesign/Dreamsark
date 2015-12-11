module.exports = (function (e) {

    /**
     * Append Camera to Engine
     */
    return e.tween = {

        tween: null,

        init: function () {
            this.tween = this;
        },

        create: function (obj, ease, callback, onComplete, context) {

            /**
             * if not an object then assume it is a duration only
             */
            if (!e.helpers.isObject(ease))
                ease = {duration: ease};

            var defaults = {
                begin: 0,
                ease: 'quintInOut',
                duration: 1,
                complete: onComplete || function () {
                }
            };

            e.helpers.extend(defaults, ease);

            /**
             * if Origin is set, subtract it from origin to readd in the end
             */
            if (e.helpers.isObject(defaults.origin))
                obj = e.helpers.sub(defaults.origin, obj);

            /**
             * amplify to time base
             * @type {number}
             */
            defaults.duration *= 1000;

            var instance = {},
                checker  = e.module('checker').class;

            checker.add(function (elapsed_time) {

                if (elapsed_time <= defaults.duration) {

                    var progress = elapsed_time / defaults.duration;

                    instance = e.helpers.map(obj, function (value) {
                        return Easie[defaults.ease](progress, defaults.begin, value, 1);
                    });

                    if (e.helpers.isObject(defaults.origin))
                        instance = e.helpers.add(defaults.origin, instance);

                    /**
                     * Call the CallBack
                     */
                    callback.call(context || e, instance);

                    return false;

                }

                /**
                 * Call Complete when the time is up
                 */
                defaults.complete.call(context || e);

                /**
                 * Destroy Checker
                 */
                return true;

            }, this);

        },

        add: function (target, duration, vars) {
            return new TweenLite(target, duration, vars);
        }

    };

})(Engine);