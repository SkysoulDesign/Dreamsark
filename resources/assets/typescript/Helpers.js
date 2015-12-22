var DreamsArk;
(function (DreamsArk) {
    var Helpers;
    (function (Helpers) {
        Helpers.init = function (items) {
            if (items === void 0) { items = []; }
            /**
             * Init All items in a row
             */
            exports.each(items, function (item, name) {
                item[name] = new item;
            }).init();
        };
    })(Helpers = DreamsArk.Helpers || (DreamsArk.Helpers = {}));
})(DreamsArk || (DreamsArk = {}));
;
exports.each = function (items, callback, context) {
    if (items === void 0) { items = []; }
    if (context === void 0) { context = DreamsArk; }
    if (is.Array(items))
        items.forEach(callback.bind(context));
    if (is.Object(items))
        Object.keys(items).forEach(function (name) {
            callback.call(context, items[name], name);
        });
};
var is = (function () {
    function is() {
    }
    is.Array = function (item) {
        return Array.isArray(item);
    };
    is.Object = function (item) {
        return (typeof item === "object" && !Array.isArray(item) && item !== null);
    };
    return is;
})();
exports.is = is;
//# sourceMappingURL=Helpers.js.map