module.exports = (function (e) {

    return {

        constructor: function (E) {
            return {
                maxConnections: 100,
                limitConnections: false,
                INTERSECTED: null,
                PARTICLE_SIZE: 20,
            }
        },

        setup: function (data, E) {

            /**
             * Scene Settings
             */
            e.scene.a.add(E.particles);

            /**
             * Camera Settings
             */
            e.camera.a.position.z = 250;

            /**
             * Plugin Init
             */
            e.plugins.OrbitControls.init();

            e.events.add('mousemove', window, function (mouse, event) {
                mouse.x = ( event.clientX / window.innerWidth ) * 2 - 1;
                mouse.y = -( event.clientY / window.innerHeight ) * 2 + 1;
            });

            e.events.add('click', window, function (mouse, event) {
                console.log(e.raycaster.intersected);
            });

            //e.helpers.timeout(5000, function () {
            //    e.compositor.next();
            //});

        },

        GUI: {
            controller: function (data) {
                return {
                    maxPoints: data.maxPoints,
                    minDistance: data.minDistance,
                    maxConnections: data.maxConnections,
                    limitConnections: data.limitConnections,
                }
            },
            gui: function (controller, data, gui) {
                gui.add(data, 'maxPoints', 0, 200);
                gui.add(data, 'minDistance', 0, 500);
                gui.add(data, 'maxConnections', 0, 30);
                gui.add(data, 'limitConnections')
            }
        },

        raycaster: function (data, E) {

            this.setFromCamera(e.events.mouse, e.camera.a);
            //this.params.Points.threshold = 10;

            var intersects = this.intersectObjects(data.particles);

            this.on(function (index) {

            });

            this.out(function (index) {

            });

            //if (intersects.length > 0) {
            //
            //    if (data.INTERSECTED != intersects[0].index) {
            //
            //        data.INTERSECTED = intersects[0].index;
            //
            //        e.tween.l(intersects[0].object.material, .3, {
            //            size: 100
            //        });
            //
            //    }
            //
            //} else if (data.INTERSECTED !== null) {
            //
            //    e.tween.l(data.particles[data.INTERSECTED].material, .3, {
            //        size: 50
            //    });
            //
            //    data.INTERSECTED = null;
            //
            //}

        },

        animation: function (data, E) {

            var lines  = data.lines,
                points = data.points;

            var vertexPos   = 0,
                colorPos    = 0,
                connections = 0;

            for (var i = 0; i < data.maxPoints; i++) {

                var particleData = data.particlesData[i];

                if (data.limitConnections && particleData.connections >= data.maxConnections)
                    continue;

                for (var j = i + 1; j < data.maxPoints; j++) {

                    var particleDataB = data.particlesData[j];

                    if (data.limitConnections && particleDataB.connections >= data.maxConnections)
                        continue;

                    var dx   = points[i * 3] - points[j * 3];
                    var dy   = points[i * 3 + 1] - points[j * 3 + 1];
                    var dz   = points[i * 3 + 2] - points[j * 3 + 2];
                    var dist = Math.sqrt(dx * dx + dy * dy + dz * dz);

                    if (dist < data.minDistance) {

                        particleData.connections++;
                        particleDataB.connections++;

                        lines.vertices[vertexPos++] = points[i * 3];
                        lines.vertices[vertexPos++] = points[i * 3 + 1];
                        lines.vertices[vertexPos++] = points[i * 3 + 2];

                        lines.vertices[vertexPos++] = points[j * 3];
                        lines.vertices[vertexPos++] = points[j * 3 + 1];
                        lines.vertices[vertexPos++] = points[j * 3 + 2];

                        var alpha = 1.0 - dist / data.minDistance;

                        lines.colors[colorPos++] = alpha;
                        lines.colors[colorPos++] = alpha;
                        lines.colors[colorPos++] = alpha;

                        lines.colors[colorPos++] = alpha;
                        lines.colors[colorPos++] = alpha;
                        lines.colors[colorPos++] = alpha;

                        connections++;

                    }

                }
            }

            lines.geometry.setDrawRange(0, connections * 2);
            lines.geometry.attributes.position.needsUpdate = true;
            lines.geometry.attributes.color.needsUpdate    = true;
            //points.geometry.attributes.position.needsUpdate = true;

        }

    };

})(Engine);