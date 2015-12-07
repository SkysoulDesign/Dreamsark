module.exports = function (e, scene, camera, elements) {

    return {

        load: [elements.Cube, elements.Logo, elements.Particles],

        setup: function () {

            /**
             * Manually Load Assets
             */
            //console.log('lelll')
            //camera.position.z = 10;
            //camera.position.y = 50;

            var mouse = e.module('mouse');

            mouse.click(elements.Cube, function (el) {

                console.log('click')

                logo      = elements.Logo;
                particles = elements.Particles;

                var checker = e.module('checker').class;

                checker.add(function(){
                    for (var i = 0, len = particles.geometry.vertices.length; i < len; i++) {

                        particles.geometry.vertices[i] = 0;

                    }

                    particles.verticesNeedUpdate = true;
                })


                //for (var i = 0, len = logo.geometry.attributes.position.length; i < len; i++) {
                //
                //    var particle_vertice = logo.vertices[i],
                //        //origin           = this.origins[i],
                //        destination      = logo.geometry[i % (destinations_length)],
                //        vector           = null;
                //
                //    // Position
                //    vector = new THREE.Vector3(
                //        logo.position.x + destination.x,
                //        logo.position.y + destination.y,
                //        logo.position.z + destination.z
                //    );
                //
                //    particle_vertice.x = Easie['quintInOut'](0, 0, vector.x, 1);
                //    particle_vertice.y = Easie['quintInOut'](0, 0, vector.y, 1);
                //    particle_vertice.z = Easie['quintInOut'](0, 0, vector.z, 1);
                //
                //}


            });


            //mouse.add.click(function (event) {
            //    console.log(event);
            //});

            //elements.Logo.position.y = 3;
            //elements.Cube.position.y = 3;

            //camera.target = elements.Logo.position.clone();
            scene.add(elements.Particles, elements.Cube);


        },

        share: function () {
            return {}
        },

        animation: function () {

            //elements.Cube.rotation.x += 0.05;
            //elements.Cube.rotation.y += 0.05;
            //elements.Cube.rotation.z += 0.05;
        }

    };

};