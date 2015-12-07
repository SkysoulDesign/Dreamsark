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

            var mouse   = e.module('mouse'),
                tween   = e.module('tween'),
                checker = e.module('checker').class;


            mouse.click(elements.Cube, function (el) {

                console.log('click');

                var particles = elements.Particles,
                    positions = particles.geometry.getAttribute('position'),
                    time      = +new Date(),
                    duration  = 6000;

                //var final = new THREE.Vector3(Math.random() * 4, Math.random() * 4, Math.random() * 4);

                var final = [];

                e.helpers.for(positions.count, function (i) {
                    var initial = new THREE.Vector3(positions.array[i * 3], positions.array[i * 3 + 1], positions.array[i * 3 + 2]);
                    final[i]    = new THREE.Vector3(initial.x * Math.random() * 4, initial.y * Math.random() * 4, initial.z * Math.random() * 4)
                });

                tween.create(final, duration, function (obj, raw) {

                    e.helpers.for(positions.count, function (i) {

                        var initial = new THREE.Vector3(positions.array[i * 3], positions.array[i * 3 + 1], positions.array[i * 3 + 2]);

                        positions.array[i * 3]     = initial.x + obj[i].x;
                        positions.array[i * 3 + 1] = initial.y + obj[i].y;
                        positions.array[i * 3 + 2] = initial.z + obj[i].z;

                    });

                    positions.needsUpdate = true;

                });

                //checker.add(function () {
                //
                //    positions.needsUpdate = true;
                //
                //    var elapsed_time = (+new Date()) - time;
                //
                //    if (elapsed_time < duration) {
                //
                //        var progress = elapsed_time / duration;
                //
                //        e.helpers.for(positions.count, function (i) {
                //
                //            var initial = new THREE.Vector3(positions.array[i * 3], positions.array[i * 3 + 1], positions.array[i * 3 + 2]);
                //
                //            var final = new THREE.Vector3(initial.x * Math.random() * 4, initial.y * Math.random() * 4, initial.z * Math.random() * 4)
                //
                //            positions.array[i * 3]     = initial.x + Easie.quintInOut(progress, 0, final.x, 1);
                //            positions.array[i * 3 + 1] = initial.y + Easie.quintInOut(progress, 0, final.y, 1);
                //            positions.array[i * 3 + 2] = initial.z + Easie.quintInOut(progress, 0, final.z, 1);
                //
                //
                //            //tween.add(vector, 2, {
                //            //    x: vector.x * Math.random() * 3, onComplete: function () {
                //            //
                //            //    }, onUpdate: function () {
                //            //        positions.array[i * 3] = vector.x;
                //            //    }, ease: Power4.easeInOut
                //            //});
                //            //tween.add(vector, 2, {
                //            //    y: vector.y * Math.random() * 3, onUpdate: function () {
                //            //        positions.array[i * 3 + 1] = vector.y;
                //            //    }, ease: Power4.easeInOut
                //            //});
                //            //tween.add(vector, 2, {
                //            //    z: vector.z * Math.random() * 3, onUpdate: function () {
                //            //        positions.array[i * 3 + 2] = vector.z;
                //            //    }, ease: Power4.easeInOut
                //            //});
                //
                //        });
                //    }
                //
                //});

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