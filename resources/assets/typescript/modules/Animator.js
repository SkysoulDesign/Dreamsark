var DreamsArk;
(function (DreamsArk) {
    var Modules;
    (function (Modules) {
        var Animator = (function () {
            function Animator() {
            }
            //backIn()function (time, begin, change, duration, overshoot) {
            //    if (overshoot == null) {
            //        overshoot = 1.70158;
            //    }
            //    return change * (time /= duration) * time * ((overshoot + 1) * time - overshoot) + begin;
            //};
            Animator.prototype.backIn = function (parameters, context) {
                var tween = new Tween(parameters, context).start();
            };
            ;
            return Animator;
        })();
        Modules.Animator = Animator;
        {
            duration: number, destination;
            any, update;
            Function;
        }
    })(Modules = DreamsArk.Modules || (DreamsArk.Modules = {}));
})(DreamsArk || (DreamsArk = {}));
var Tween = (function () {
    function Tween(parameters, context) {
        this.duration = parameters.duration;
        this.destination = parameters.destination;
        this.update = parameters.update;
    }
    Tween.prototype.start = function () {
        var checker = module('Checker');
        checker.add(function (elapsed_time) {
            if (elapsed_time <= this.duration * 1000) {
                var progress = elapsed_time / this.duration;
                //instance = e.helpers.map(obj, function (value) {
                //    return Easie[defaults.ease](progress, defaults.begin, value, 1);
                //});
                //
                //if (defaults.origin !== false)
                //    instance = e.helpers.add(instance, defaults.origin);
                /**
                 * Call the CallBack
                 */
                this.callback.call(this.context);
                return false;
            }
        }, this);
    };
    return Tween;
})();
exports.Tween = Tween;
//# sourceMappingURL=Animator.js.map