module.exports = (function (e, c) {

    /**
     * Raycaster
     * @type {THREE.Raycaster}
     */
    var raycaster = new THREE.Raycaster();

    raycaster.params.Points.threshold = 10;

    return e.raycaster = {
        intersected: null,
        a: raycaster,
        init: function () {
            return this.a = new THREE.Raycaster();
        },
        calculate: function () {

            /**
             * If not set, Initialize it
             */
            if (this.a === null) {
                this.init();
            }

            this.active.raycaster.call(this.a, this.public, e.elements);

        }
    };

})(Engine, Configs);