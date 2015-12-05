module.exports = function (e, scene, camera, elements) {

    return {

        setup: function () {

            /**
             * Manually Load Assets
             */
            e.loader.load(elements.Cube);
            camera.position.z = 5;
            scene.add(elements.Cube);

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