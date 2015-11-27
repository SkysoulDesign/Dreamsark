module.exports = (function () {

    return {
        name: 'dreamsark',
        create: function (e) {
            var parameters = {
                size: 5.0,
                //height: '',
                //curveSegments: '',
                //font: '',
                //weight: '',
                //style: '',
                //bevelEnabled: '',
                //bevelThickness: '',
                //bevelSize: ''
            };
            return new THREE.TextGeometry('DREAMSARK', parameters);
        }
    }

})();