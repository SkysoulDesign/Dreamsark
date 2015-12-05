module.exports = (function () {

    return {
        name: 'dreamsark',
        maps: function () {
            return {
                texture: 'lib/dreamsark.png'
            }
        },
        share: function () {

            return {
                factor: 100
            }

        },
        create: function (e, maps, share) {


            var geometry = new THREE.PlaneGeometry(4 * share.factor, share.factor, 1);
            var map      = maps.texture;

            var material = new THREE.MeshBasicMaterial({
                side: THREE.DoubleSide,
                map: map,
                transparent: true
            });

            return new THREE.Mesh(geometry, material);

        }
    }

})();