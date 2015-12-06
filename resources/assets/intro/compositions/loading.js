module.exports = function (e, scene, camera, elements) {

    return {

        load: [elements.Cube, elements.Logo],

        setup: function () {

            /**
             * Manually Load Assets
             */
                //console.log('lelll')
                //camera.position.z = 10;
                //camera.position.y = 50;

            elements.Logo.position.y = 3;
            elements.Cube.position.y = 3;

            //camera.target = elements.Logo.position.clone();
            scene.add(elements.Logo, elements.Cube);


        },

        share: function () {
            return {}
        },

        animation: function () {

            elements.Cube.rotation.x += 0.05;
            elements.Cube.rotation.y += 0.05;
            elements.Cube.rotation.z += 0.05;
        }

    };

};