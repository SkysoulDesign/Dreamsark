module.exports = (function (e) {

    return {

        constructor: function (E) {
            return {
                maxConnections: 100,
                limitConnections: false,
            }
        },

        setup: function (data, E) {

            /**
             * Scene Settings
             */
            e.scene.a.add(E.particles, E.skybox);

            /**
             * Camera Settings
             */
            e.camera.a.position.z = 250;

            /**
             * Plugin Init
             */
            e.plugins.OrbitControls.init();

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
                gui.add(data, 'minDistance', 0, 50);
                gui.add(data, 'maxConnections', 0, 30);
                gui.add(data, 'limitConnections')
            }
        },

        animation: function (data, E) {
            //return;
            var lines  = data.lines,
                points = data.points;

            var vertexPos   = 0,
                colorPos    = 0,
                connections = 0;

            for (var i = 0; i < data.maxPoints; i++) {

                var particleData = data.particlesData[i];

                //points.vertices[ i * 3     ] += particleData.velocity.x / 150;
                //points.vertices[ i * 3 + 1 ] += particleData.velocity.y / 150;
                //points.vertices[ i * 3 + 2 ] += particleData.velocity.z / 150;

                if (data.limitConnections && particleData.connections >= data.maxConnections)
                    continue;

                for (var j = i + 1; j < data.maxPoints; j++) {

                    var particleDataB = data.particlesData[j];

                    if (data.limitConnections && particleDataB.connections >= data.maxConnections)
                        continue;

                    var dx   = points.vertices[i * 3] - points.vertices[j * 3];
                    var dy   = points.vertices[i * 3 + 1] - points.vertices[j * 3 + 1];
                    var dz   = points.vertices[i * 3 + 2] - points.vertices[j * 3 + 2];
                    var dist = Math.sqrt(dx * dx + dy * dy + dz * dz);

                    if (dist < data.minDistance) {

                        particleData.connections++;
                        particleDataB.connections++;

                        lines.vertices[vertexPos++] = points.vertices[i * 3];
                        lines.vertices[vertexPos++] = points.vertices[i * 3 + 1];
                        lines.vertices[vertexPos++] = points.vertices[i * 3 + 2];

                        lines.vertices[vertexPos++] = points.vertices[j * 3];
                        lines.vertices[vertexPos++] = points.vertices[j * 3 + 1];
                        lines.vertices[vertexPos++] = points.vertices[j * 3 + 2];

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

            lines.geometry.setDrawRange( 0, connections * 2 );
            lines.geometry.attributes.position.needsUpdate  = true;
            lines.geometry.attributes.color.needsUpdate     = true;
            points.geometry.attributes.position.needsUpdate = true;

        }

    };

})(Engine);