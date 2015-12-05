module.exports = (function () {

    return {
        name: 'Cube',

        maps: function () {
            return {
                texture: 'lib/point-1.png',
                texture1: 'lib/point-2.png',
                texture2: 'lib/point-3.png',
                texture3: 'lib/point-4.png',
                texture4: 'lib/test.jpg',
                texture7: 'lib/universe.jpg',
                texture5: 'lib/universe.png',
                texture6: 'lib/particles.png',
                texture72: 'lib/ground.png',
                texture73: 'lib/ground.png',
                texture74: 'lib/ground.png',
                texture75: 'lib/ground.png',
                texture76: 'lib/ground.png',
                texture77: 'lib/ground.png'
            }
        },

        create: function (e, maps, share) {

            var geometry = new THREE.BoxGeometry(1, 1, 1);
            var material = new THREE.MeshBasicMaterial({color: 0x00ff00});
            return new THREE.Mesh(geometry, material);

        }

    }

})();