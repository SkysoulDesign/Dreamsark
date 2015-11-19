module.exports = (function () {

    return {
        name: 'Skybox',
        object: function () {

            var map = (new THREE.TextureLoader()).load('lib/universe.jpg');
            var geo = new THREE.SphereGeometry(500, 50, 50);
            geo.scale(-1, 1, 1);
            var mat = new THREE.MeshBasicMaterial({map: map});
            return new THREE.Mesh(geo, mat);

        }
    }

})();