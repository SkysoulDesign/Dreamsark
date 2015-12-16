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
            this.start();

        },

        configure: function (configs) {
            this.params.Points.threshold = 2;
        },

        click: function (element, group, callback, context) {

            /**
             * Push Element to Collection
             */
            this.add(element);

            this.clicksBag.push({
                element: element,
                callback: callback,
                context: context,
                type: 'click',
                group: group
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

        hover: function (element, group, callbackIn, callbackOut, context) {

            this.add(element);

            this.clicksBag.push({
                element: element,
                callbackIn: callbackIn,
                callbackOut: callbackOut,
                context: context,
                type: 'hover',
                group: group
            });

        },

        hoverClick: function (element, group, callbackIn, callbackOut, callbackClick, context) {

            this.add(element);

            this.clicksBag.push({
                element: element,
                callbackIn: callbackIn,
                callbackOut: callbackOut,
                callback: callbackClick,
                context: context,
                type: 'hoverClick',
                group: group
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

        delete: function (index, group) {

            var bag = this.clicksBag;

            /**
             * remove entire group if set
             */
            if (e.helpers.isNull(group) && !e.helpers.isNull(bag[index].group)) {

                var bagGroup = bag[index].group,
                    indexes  = [];

                e.helpers.keys(bag, function (el, ind) {

                    /**
                     * find where group are equivalent
                     */
                    if (el.group === bagGroup)
                        indexes.push(ind);

                }, this);

                /**
                 * Make it from bigger to smaller
                 */
                indexes.sort(function (a, b) {
                    return b - a
                });

                e.helpers.keys(indexes, function (el) {

                    this.delete(el, bagGroup);

                }, this);

                return;

            }

            if (e.helpers.isObject(index)) {

                /**
                 * Loop on bag to find a match
                 */
                e.helpers.keys(bag, function (el, ind) {

                    /**
                     * find where type and element are equivalent
                     */
                    if (el.type === index.type && el.element === index.element)
                        return this.delete(ind);

                }, this);

            }

            bag.splice(index, 1);

        },

        start: function () {

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

                                el.callbackIn.call(el.context || e, el.element);

                                if (!e.helpers.isNull(this.watcher.hover.el) && this.watcher.hover.el.element !== el.element)
                                    this.hoverOut();

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

            }, this, 'Raycaster, Checking for click events');

        }

    };

})(Engine);