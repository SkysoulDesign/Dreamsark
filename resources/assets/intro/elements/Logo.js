module.exports = (function () {

    return {

        name: 'logo',

        objs: function () {
            return {
                logo: 'models/ship.obj'
            }
        },

        create: function (e, share, maps, objs) {

            var material = new THREE.MeshBasicMaterial({
                color: new THREE.Color('blue'),
                wireframe: true
            });

            objs.logo.rotation.x = -Math.PI / 2;
            objs.logo.material   = material;

            return objs.logo;

        },

    }

})();