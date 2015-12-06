module.exports = (function (e) {

    /**
     * Append Checker to Engine
     */
    return e.checker = {

        collection: [],
        checker: null,

        init: function () {
            this.checker = this;
        },

        add: function (callback, context) {
            this.collection.push(callback.bind(context || e));
        },

        delete: function (index) {
            this.collection.splice(index, 1);
        },

        reset: function () {
            this.collection = [];
        },

        update: function () {

            var checker = this;

            if (e.helpers.length(checker.collection) >= 1)

                e.helpers.keys(this.collection, function (el, index) {

                    if (el.call())
                        checker.delete(index);

                });

        }
    }

})(Engine);