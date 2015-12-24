var DreamsArk;
(function (DreamsArk) {
    var Helpers;
    (function (Helpers) {
        Helpers.init = function (items) {
            if (items === void 0) { items = []; }
            /**
             * Init All items in a row
             */
            Helpers.each(items, function (item) {
                var component = new item, instance = component.instance;
                if (is.Function(component.configure))
                    component.configure();
                item.instance = instance ? instance : component;
            });
        };
        Helpers.query = function (element) {
            return document.querySelector(element);
        };
        Helpers.each = function (items, callback, context) {
            if (items === void 0) { items = []; }
            if (context === void 0) { context = DreamsArk; }
            if (is.Array(items))
                items.forEach(callback.bind(context));
            if (is.Object(items))
                Object.keys(items).forEach(function (name) {
                    callback.call(context, items[name], name);
                });
        };
        Helpers.For = function (max, callback, context, reverse) {
            if (context === void 0) { context = DreamsArk; }
            if (reverse === void 0) { reverse = false; }
            /**
             * if it's array of object
             */
            if (is.Array(max) || is.Object(max))
                max = Helpers.length(max);
            /**
             * Play for on Reverse
             */
            if (reverse === true) {
                for (var i = max - 1; i >= 0; i--)
                    if (callback.call(context, i))
                        break;
                return;
            }
            for (var i = 0; i < max; i++) {
                if (callback.call(context, i))
                    break;
            }
        };
        Helpers.length = function (item) {
            if (item === void 0) { item = []; }
            if (is.Array(item))
                return item.length;
            if (is.Object(item)) {
                var length = 0;
                Helpers.each(item, function () {
                    length++;
                });
                return length;
            }
        };
        Helpers.filter = ;
        Helpers.each(obj, function (el, key) {
            if (obj.hasOwnProperty(key)) {
                Helpers.result[key] = predicate[key];
            }
        });
        console.log(Helpers.result);
        //for (key in obj) {
        //
        //}
        return Helpers.result;
    })(Helpers = DreamsArk.Helpers || (DreamsArk.Helpers = {}));
})(DreamsArk || (DreamsArk = {}));
;
/**
 * Dom Utils
 */
exports.appendTo = function (element, domElement) {
    document.querySelector(element).appendChild(domElement);
};
exports.removeById = function (collection, id) {
    For(collection, function (index) {
        if (collection[index].id === id)
            collection.splice(index, 1);
    });
};
/**
 * Checker if obj is X type
 */
var is = (function () {
    function is() {
    }
    is.Array = function (item) {
        return Array.isArray(item);
    };
    is.Object = function (item) {
        return (typeof item === "object" && !Array.isArray(item) && item !== null);
    };
    is.Null = function (item) {
        return (item === null || item === undefined || item === 0 || item === '0');
    };
    is.Function = function (item) {
        return !!(item && item.constructor && item.call && item.apply);
    };
    is.Image = function (item) {
        var ext = item.split('.').pop();
        return (ext === 'jpg' || ext === 'png');
    };
    is.OBJ = function (item) {
        var ext = item.split('.').pop();
        return (ext === 'obj');
    };
    return is;
})();
exports.is = is;
var random = (function () {
    function random() {
    }
    random.id = function (length, radix) {
        if (length === void 0) { length = 27; }
        if (radix === void 0) { radix = 36; }
        return (Math.random() + 1).toString(radix).substring(2, length + 2);
    };
    return random;
})();
exports.random = random;
var where = (function () {
    function where() {
    }
    where.id = function (collection, id) {
        var occurrence = [];
        each(collection, function (element) {
            if (element.id === id)
                occurrence = element;
        });
        return occurrence;
    };
    where.name = function (collection, id) {
        var occurrences = [];
        each(collection, function (element) {
            if (element.id === id)
                occurrences.push(element);
        });
        return length(occurrences) > 0 ? occurrences[0] : occurrences;
    };
    return where;
})();
exports.where = where;
//# sourceMappingURL=Helpers.js.map