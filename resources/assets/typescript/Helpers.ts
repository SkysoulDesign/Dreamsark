module DreamsArk.Helpers {

    export var init = function (items:any = []) {

        /**
         * Init All items in a row
         */
        each(items, function (item) {

            var component = new item,
                instance = component.instance;

            if (is.Function(component.configure))
                component.configure();

            item.instance = instance ? instance : component;

        });

    };

    export var query = function (element:string):Element {
        return document.querySelector(element);
    };

    export var each = function (items:any[] = [], callback, context:any = DreamsArk) {

        if (is.Array(items))
            items.forEach(callback.bind(context));

        if (is.Object(items))
            Object.keys(items).forEach(function (name) {
                callback.call(context, items[name], name);
            });

    };

    export var For = function (max:any, callback, context = DreamsArk, reverse:boolean = false) {

        /**
         * if it's array of object
         */
        if (is.Array(max) || is.Object(max))
            max = length(max);

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

    export var length = function (item:any[] = []):number {

        if (is.Array(item))
            return item.length;

        if (is.Object(item)) {

            var length = 0;

            each(item, function () {
                length++
            });

            return length;

        }

    };

    export var contains = function (items:any, element:string):boolean {

        if (is.Array(items))
            return items.indexOf(element) > -1;

        if (is.Object(items))
            console.log('is Object Please finish implementing this function')

        return false;
    };

    export var reverse = function (items:any[]) {
        return items.sort(function (a, b) {
            return b - a
        });
    };

    export var filter = function (obj:any, list:string[]) {

        var result = {};

        each(obj, function (el, key) {

            if (contains(list, key))
                result[key] = obj[key];

        });

        return result;

    };

    /**
     * Dom Utils
     */
    export var appendTo = function (element, domElement) {
        document.querySelector(element).appendChild(domElement);
    };

    export var removeById = function (collection, id:string) {

        For(collection, function (index) {

            if (collection[index].id === id)
                collection.splice(index, 1);

        });

    };

    /**
     * Checker if obj is X type
     */
    export class is {

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

        static Image(item:string):boolean {
            var ext = item.split('.').pop();
            return (ext === 'jpg' || ext === 'png');
        }

        static OBJ(item:string):boolean {
            var ext = item.split('.').pop();
            return (ext === 'obj');
        }

    }

    export class random {

        static id(length:number = 27, radix:number = 36):string {
            return (Math.random() + 1).toString(radix).substring(2, length + 2);
        }

        static vector3(x:number = 0, y:number = 0, z:number = 0, distance:number = 0, stick:boolean = false):THREE.Vector3 {

            // Coordinates
            var u1 = Math.random() * 2 - 1,
                u2 = Math.random(),
                radius = Math.sqrt(1 - u1 * u1),
                theta = 2 * Math.PI * u2;

            // Stick to surface or disperse inside sphere
            if (!stick)
                distance = Math.random() * distance;

            return new THREE.Vector3(
                radius * Math.cos(theta) * distance + x,
                radius * Math.sin(theta) * distance + y,
                u1 * distance + z
            );


        }

    }

    export class where {

        static id(collection:any[], id:string):any {

            var occurrence = [];

            each(collection, function (element) {

                if (element.id === id)
                    occurrence = element

            });

            return occurrence;

        }

        static name(collection:any[], id:string):any {

            var occurrences = [];

            each(collection, function (element) {

                if (element.id === id)
                    occurrences.push(element)

            });

            return length(occurrences) > 0 ? occurrences[0] : occurrences;

        }

    }

}