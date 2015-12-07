module.exports = (function () {

    return {

        name: 'particles',

        objs: function () {
            return {
                car: 'models/audi_tt.obj',
                seila: 'models/audi_tt.obj'
            }
        },

        maps: function () {
            return {
                spark: 'lib/spark-9.png'
            }
        },

        share: function () {

            var morph = this.morph;

            return {
                morph: morph
            }

        },

        morph: function () {
            console.log('power rangers')
        },

        create: function (e, share, maps, objs) {

            //var uniforms =
            //    {
            //        texture: {type: 't', value: maps.spark},
            //        pixel_ratio: {type: 'f', value: window.devicePixelRatio},
            //        perlin_intensity: {type: 'f', value: 60},
            //        perlin_frequency: {type: 'f', value: 0.014},
            //        time: {type: 'f', value: 0},
            //        particles_size: {type: 'f', value: 3},
            //        particles_color: {type: 'c', value: new THREE.Color('#eb4927')}
            //    };
            //
            var attributes =
                {
                    alpha: {type: 'f', value: []}
                };
            //
            //// Materials
            //var particles_material = new THREE.ShaderMaterial(
            //    {
            //        attributes: attributes,
            //        uniforms: uniforms,
            //        vertexShader: document.getElementById('vertexshader').textContent,
            //        fragmentShader: document.getElementById('fragmentshader').textContent,
            //        transparent: true,
            //        blending: THREE.AdditiveBlending,
            //        depthTest: false,
            //        // alphaTest      : 0.5,
            //        // vertexColors    : true
            //    });

            models =
                [
                    {
                        type: 'cloud',
                        position: {x: 0, y: 0, z: 0}
                    }
                ];

            var particles_material = new THREE.PointsMaterial({
                map: maps.spark,
                color: 0xffffff,
                size: 0.5,
                sizeAttenuation: true,
                vertexColors: false
            });


            // Cloud
            var cloud_vertices = [];

            for (i = 0; i < 2000; i++) {

                //var origin = this.get_random_vector_3(0,0,0,200 / 4,true);
                //
                //cloud_vertices.push(origin);

                var origin = this.get_random_vector_3(0, 0, 0, 200, false);
                origin.y /= 3;

                cloud_vertices.push(origin);
            }

            // Add to models
            models.push({
                position: {
                    x: 0,
                    y: 0,
                    z: 0
                },
                geometry: cloud_vertices
            });

            var particles_geometry = new THREE.Geometry();

            var origins = [];

            for (var i = 0; i < 2000; i++) {
                origins.push(models[1].geometry[i].clone());
                particles_geometry.vertices.push(models[1].geometry[i].clone());
                attributes.alpha.value[i] = Math.random() * 0.9;
            }

            var particles_system = new THREE.Points(particles_geometry, particles_material);

            particles_system.position.set(0, 50, 0);
            particles_system.dynamic = true;


            return particles_system;

        },


        /**
         * Temp
         */
        get_random_vector_3: function (x, y, z, distance, stick_to_surface) {
            // Defaults
            x                = x || 0;
            y                = y || false;
            z                = z || false;
            distance         = distance || false;
            stick_to_surface = stick_to_surface || false;

            // Cordinates
            var u1    = Math.random() * 2 - 1,
                u2    = Math.random(),
                r     = Math.sqrt(1 - u1 * u1),
                theta = 2 * Math.PI * u2;

            // Stick to surface or disperce inside sphere
            if (!stick_to_surface)
                distance = Math.random() * distance;

            // Return
            return new THREE.Vector3(
                r * Math.cos(theta) * distance + x,
                r * Math.sin(theta) * distance + y,
                u1 * distance + z
            );
        },

    }

})();