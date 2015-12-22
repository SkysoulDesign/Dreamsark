module DreamsArk.Helpers {

    export var init = function (items:any = []) {

        /**
         * Init All items in a row
         */
        each(items, function (item) {
            item.instance = (new item).instance;
        });

    };

    export var each = function (items = [], callback, context = DreamsArk) {

        if (is.Array(items))
            items.forEach(callback.bind(context));

        if (is.Object(items))
            Object.keys(items).forEach(function (name) {
                callback.call(context, items[name], name);
            });

    };

    export class is {

        constructor() {

        }

        static Array(item:any):boolean {
            return Array.isArray(item);
        }

        static Object(item:any):boolean {
            return (typeof item === "object" && !Array.isArray(item) && item !== null);
        }

        static Null(item:any):boolean {
            return (item === null || item === undefined || item === 0 || item === '0');
        }

        static Function(item:any):boolean {
            return !!(item && item.constructor && item.call && item.apply);
        }

    }

}