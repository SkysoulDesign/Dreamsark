module.exports = (function (e) {

    /**
     * Append Camera to Engine
     */
    return e.raycaster = {

        raycaster: null,
        collection: [],
        clicksBag: [],

        watcher: {
            click: false,
            mousemove: false,
            hover: {
                active: false,
                el: null,
                status: false
            }
        },

        init: function () {

            this.raycaster = new THREE.Raycaster();

            var mouse = e.module('mouse');

            /**
             * Set Watcher
             */
            mouse.click(document, function (event) {
                this.watcher.click = true;
            }, this);

            /**
             * Set Watcher
             */
            mouse.move(document, function (event) {
                this.watcher.mousemove    = true;
                this.watcher.hover.active = true;
            }, this);

            /**
             * Calculate intersections
             */
            this.update();

        },

        configure: function (configs) {
            this.params.Points.threshold = 2;
        },

        click: function (element, callback, context) {

            /**
             * Push Element to Collection
             */
            this.add(element);

            this.clicksBag.push({
                element: element,
                callback: callback,
                context: context,
                type: 'click'
            });

        },

        move: function (element, callback, context) {

            this.add(element);

            this.clicksBag.push({
                element: element,
                callback: callback,
                context: context,
                type: 'mousemove'
            });

        },

        hover: function (element, callbackIn, callbackOut, context) {

            this.add(element);

            this.clicksBag.push({
                element: element,
                callbackIn: callbackIn,
                callbackOut: callbackOut,
                context: context,
                type: 'hover'
            });

        },

        hoverClick: function (element, callbackIn, callbackOut, callbackClick, context) {

            this.add(element);

            this.clicksBag.push({
                element: element,
                callbackIn: callbackIn,
                callbackOut: callbackOut,
                callback: callbackClick,
                context: context,
                type: 'hoverClick'
            });

        },

        hoverOut: function () {

            var result = false;

            if (!e.helpers.isNull(this.watcher.hover.el))
                result = this.watcher.hover.el.callbackOut.call(this.watcher.hover.el.context || e, this.watcher.hover.el.element);

            /**
             * Clear the hover index
             */
            this.watcher.hover.el = null;

            return result;

        },

        resetWatcher: function () {
            this.watcher.click        = false;
            this.watcher.mousemove    = false;
            this.watcher.hover.active = false;
        },

        add: function (element) {
            this.collection.push(element);
        },

        delete: function (index) {

            var bag = this.clicksBag;

            if (e.helpers.isObject(index)) {

                /**
                 * Loop on bag to find a match
                 */
                e.helpers.keys(bag, function (el, ind) {

                    /**
                     * find where type and element are equivalent
                     */
                    if (el.type === index.type && el.element === index.element)
                        index = ind;
                });

            }

            bag.splice(index, 1);

        },


        update: function () {

            var checker = e.module('checker').class,
                mouse   = e.module('mouse'),
                camera  = e.module('camera');

            checker.add(function () {

                e.helpers.keys(this.clicksBag, function (el, index) {

                    /**
                     * Set From Camera as Default
                     */
                    this.raycaster.setFromCamera(mouse.normalized, camera);

                    var intersects = this.raycaster.intersectObjects(this.collection);

                    if (intersects.length > 0) {

                        /**
                         * Check if the first object is in the clicking bag
                         */
                        if (intersects[0].object === el.element) {

                            var result = false;

                            /**
                             * if element is clicked call it
                             */
                            if (this.watcher.click && (el.type === 'click' || el.type === 'hoverClick')) {
                                result             = el.callback.call(el.context || e, el.element);
                                this.watcher.click = false;
                            }

                            /**
                             * if element is mouse move
                             */
                            if (this.watcher.mousemove && el.type === 'mousemove') {
                                result                 = el.callback.call(el.context || e, el.element);
                                this.watcher.mousemove = false;
                            }

                            /**
                             * if element is hovered call it
                             */
                            if (this.watcher.hover.active && (el.type === 'hover' || el.type === 'hoverClick')) {

                                /**
                                 * if he has hovered over the same so return
                                 */
                                if (!e.helpers.isNull(this.watcher.hover.el) && this.watcher.hover.el.element === el.element)
                                    return;

                                result = el.callbackIn.call(el.context || e, el.element);

                                if (!e.helpers.isNull(this.watcher.hover.el) && this.watcher.hover.el.element !== el.element)
                                    result = this.hoverOut();

                                this.watcher.hover.el = el;

                            }

                            /**
                             * Remove listener if the return is true
                             */
                            if (result)
                                this.delete(index);

                        }

                    } else if ((el.type === 'hover' || el.type === 'hoverClick') && !e.helpers.isNull(this.watcher.hover.el)) {
                        this.hoverOut();
                    }

                }, this);

                /**
                 * Reset Watcher
                 */
                this.resetWatcher();

            }, this);

        }

    };

})(Engine);