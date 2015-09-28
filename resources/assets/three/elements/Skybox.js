module.exports = (function () {

    return {
        name: 'Skybox',
        object:function () {

            var map = THREE.ImageUtils.loadTexture('lib/simplexSphereMap.jpg');
            var geo = new THREE.SphereGeometry(5000, 50, 50);
            var mat = new THREE.MeshBasicMaterial({map: map, side: THREE.BackSide});
            return new THREE.Mesh(geo, mat);

        }
    }

})();