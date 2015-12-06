module.exports = (function (e) {

    /**
     * Append Camera to Engine
     */
    return e.mouse = {

        mouse: null,
        x: null, y: null,
        ratio: null,

        init: function () {

            this.mouse = this;
            this.x     = 0;
            this.y     = 0;
            this.ratio = new THREE.Vector2(0, 0);

            var events = e.module('events');
            events.add(window, 'mousemove', this.move, this);

        },

        set: function (x, y) {
            this.x = x;
            this.y = y;
        },

        move: function (event) {

            this.mouse.set(event.clientX, event.clientY);

            var browser = e.module('browser');

            if (e.helpers.isNull(browser.width) && e.helpers.isNull(browser.height)) {
                this.ratio.x = this.mouse.x / browser.innerWidth;
                this.ratio.y = this.mouse.y / browser.innerHeight;
            }

        }

    };

})(Engine);