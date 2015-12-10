module.exports = (function () {

    var maxParticleCount = 15000;
    var radius           = 200;

    return {

        name: 'particles',

        maps: function () {
            return {
                spark: 'lib/spark.png'
            }
        },

        create: function (e, share, maps, objs) {

            var PointMaterial = new THREE.PointsMaterial({
                //color: 0x000000,
                size: 0.5,
                blending: THREE.AdditiveBlending,
                transparent: true,
                map: maps.spark,
                alphaTest: 0.5,
                sizeAttenuation: true

            });

            var particles         = new THREE.BufferGeometry();
            var particlePositions = new Float32Array(maxParticleCount * 3);

            /**
             * Add Vertices to Points
             */
            e.helpers.for(maxParticleCount, function (i) {

                var x = Math.random() * radius - radius / 2;
                var y = Math.random() * radius - radius / 2;
                var z = Math.random() * radius - radius / 2;

                particlePositions[i * 3]     = x;
                particlePositions[i * 3 + 1] = y;
                particlePositions[i * 3 + 2] = z;

            });

            particles.addAttribute('position', new THREE.BufferAttribute(particlePositions, 3).setDynamic(true));
            //particles.setDrawRange(0, particleCount);

            var mesh = new THREE.Points(particles, PointMaterial);

            return {
                mesh: mesh,
                count: 6258 + 60 + 34,
                radius: 200,
                index: 0,
                animating: false,
                restarting: false,
                vertices: mesh.geometry.getAttribute('position'),
                origin: mesh.geometry.getAttribute('position').array.slice(),
                final: [],

                for: function (name, count, callback, context) {

                    var final  = [],
                        origin = this.origin;

                    e.helpers.for2(count, this.index, function (i, j) {

                        var destination = callback.call(context || e, j);

                        destination.x += origin[i * 3];
                        destination.y += origin[i * 3 + 1];
                        destination.z += origin[i * 3 + 2];

                        final.push(destination);

                    }, this);

                    if (this.index > this.count) {
                        console.log('you have used more particles than you have, please add more', this.index - this.count);
                    }

                    this.final.push({
                        name: name,
                        data: final,
                        index: this.index
                    });

                    this.index += count;

                },

                tween: function (name, time, o) {

                    this.animating = true;

                    var tween    = e.module('tween').class,
                        vertices = this.vertices,
                        origin   = this.origin,
                        final    = this.final;

                    var options = e.helpers.extend({duration: time}, o);

                    e.helpers.keys(final, function (el) {

                        /**
                         * Tween only the specified name
                         */
                        if (name !== el.name && name !== 'all') return;

                        /**
                         * Remove Array from Final and set animating to false if final is empty
                         */
                        var onComplete = function () {

                            final.shift();

                            if (!e.helpers.length(final))
                                this.animating = false

                        };

                        tween.create(el.data, options, function (obj) {

                            e.helpers.for2(el.data.length, el.index, function (i, j) {

                                if (!obj[j]) return;

                                vertices.array[i * 3]     = origin[i * 3] - obj[j].x;
                                vertices.array[i * 3 + 1] = origin[i * 3 + 1] - obj[j].y;
                                vertices.array[i * 3 + 2] = origin[i * 3 + 2] - obj[j].z;

                            });

                            /**
                             * Update Vertices
                             * @type {boolean}
                             */
                            vertices.needsUpdate = true;

                        }, onComplete, this);

                    }, this);

                },

                tweenAll: function (time, options) {
                    this.tween('all', time, options);
                },

                reset: function () {
                    this.index     = 0;
                    this.origin    = this.mesh.geometry.getAttribute('position').array.slice();
                    this.animating = false;
                }

            };

        }

    }

})();