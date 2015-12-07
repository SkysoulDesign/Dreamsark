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
            mousemove: false
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
                this.watcher.mousemove = true;
            }, this);

            /**
             * Calculate intersections
             */
            this.update();

        },

        configure: function (configs) {
            this.params.Points.threshold = 10;
        },

        click: function (element, callback, context) {

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

                        if (intersects[0].object === el.element) {

                            var result = false;

                            /**
                             * if element is clicked call it
                             */
                            if (this.watcher.click && el.type === 'click') {
                                result             = el.callback.call(el.context || e, el);
                                this.watcher.click = false;
                            }

                            /**
                             * if element is mouse move
                             */
                            if (this.watcher.mousemove && el.type === 'mousemove') {
                                result                 = el.callback.call(el.context || e, el);
                                this.watcher.mousemove = false;
                            }

                            /**
                             * Remove listener if the return is true
                             */
                            if (result)
                                this.delete(index);

                        }

                    }

                }, this);

            }, this);

        }

    };

})(Engine);