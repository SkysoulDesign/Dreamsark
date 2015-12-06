module.exports = (function (e) {

    /**
     * Append Camera to Engine
     */
    return e.events = {

        events: null,
        collection: [],

        init: function () {

            this.events = this;

        },

        add: function (element, event, callback, context, useCapture) {

            element.addEventListener(event, callback.bind(context || e), useCapture || false);

            /**
             * push the element to the collection
             */
            this.collection.push({
                element: element,
                event: event
            });
        }

    };

})(Engine);