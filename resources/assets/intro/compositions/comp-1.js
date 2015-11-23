module.exports = (function (e) {

    var INTERSECTED;

    return {

        constructor: function (E) {
            return {
                limitConnections: false,
                maxConnections: 50,
                maxParticleCount: 1000,
                minDistance: 150,
                particleCount: 260
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
            e.camera.a.position.z = 1750;

            /**
             * Plugin Init
             */
            e.plugins.OrbitControls.init();

            /**
             * RayCaster
             */
            data.raycaster = new THREE.Raycaster();
            data.raycaster.params.Points.threshold = 5;

            data.mouse = new THREE.Vector2();

            document.addEventListener('mousemove', onDocumentMouseMove, false);

            function onDocumentMouseMove(event) {

                event.preventDefault();

                data.mouse.x = ( event.clientX / window.innerWidth ) * 2 - 1;
                data.mouse.y = -( event.clientY / window.innerHeight ) * 2 + 1;

            }

            //e.helpers.timeout(5000, function () {
            //    e.compositor.next();
            //});

        },

        GUI: {
            controller: function (data) {
                return {
                    showDots: true,
                    showLines: true,
                    minDistance: data.minDistance,
                    limitConnections: data.limitConnections,
                    maxConnections: data.maxConnections,
                    particleCount: data.particleCount
                };
            },
            gui: function (controller, data, gui) {

                gui.add(controller, "showDots").onChange(function (value) {
                    data.pointCloud.visible = value;
                }).name('Show Particles');

                gui.add(controller, "showLines").onChange(function (value) {
                    data.linesMesh.visible = value;
                });

                gui.add(controller, "minDistance", 10, 300);
                gui.add(controller, "limitConnections");
                gui.add(controller, "maxConnections", 0, 100, 1);
                gui.add(controller, "particleCount", 0, data.maxParticleCount, 1).onChange(function (value) {

                    data.particleCount = parseInt(value);
                    data.particles.setDrawRange(0, data.particleCount);

                });
            }
        },

        animation: function (data, E) {

            data.raycaster.setFromCamera(data.mouse, e.camera.a);

            var intersects = data.raycaster.intersectObject(data.pointCloud);

            if (intersects.length > 0) {

                if ( INTERSECTED != intersects[ 0 ].index ) {

                    INTERSECTED = intersects[ 0 ].index;

                    //data.pointCloud.geometry[INTERSECTED].visible = false;
                   console.log(data.pointCloud);

                }

            } else {

                //console.log('not Working')

            }

            var particlesData     = data.particlesData,
                particlePositions = data.particlePositions,
                linesMesh         = data.linesMesh,
                pointCloud        = data.pointCloud,
                radius            = data.radius,
                particleCount     = data.particleCount,
                positions         = data.positions,
                colors            = data.colors;

            var vertexpos    = 0;
            var colorpos     = 0;
            var numConnected = 0;
            var rHalf        = radius / 2;

            for (var b = 0; b < particleCount; b++)
                particlesData[b].numConnections = 0;

            for (var i = 0; i < particleCount; i++) {

                // get the particle
                var particleData = particlesData[i];

                particlePositions[i * 3] += particleData.velocity.x / 5;
                particlePositions[i * 3 + 1] += particleData.velocity.y / 5;
                particlePositions[i * 3 + 2] += particleData.velocity.z / 5;

                if (particlePositions[i * 3 + 1] < -rHalf || particlePositions[i * 3 + 1] > rHalf)
                    particleData.velocity.y = -particleData.velocity.y;

                if (particlePositions[i * 3] < -rHalf || particlePositions[i * 3] > rHalf)
                    particleData.velocity.x = -particleData.velocity.x;

                if (particlePositions[i * 3 + 2] < -rHalf || particlePositions[i * 3 + 2] > rHalf)
                    particleData.velocity.z = -particleData.velocity.z;

                if (data.limitConnections && particleData.numConnections >= data.maxConnections)
                    continue;

                // Check collision
                for (var j = i + 1; j < particleCount; j++) {

                    var particleDataB = particlesData[j];
                    if (data.limitConnections && particleDataB.numConnections >= data.maxConnections)
                        continue;

                    var dx   = particlePositions[i * 3] - particlePositions[j * 3];
                    var dy   = particlePositions[i * 3 + 1] - particlePositions[j * 3 + 1];
                    var dz   = particlePositions[i * 3 + 2] - particlePositions[j * 3 + 2];
                    var dist = Math.sqrt(dx * dx + dy * dy + dz * dz);

                    if (dist < data.minDistance) {

                        particleData.numConnections++;
                        particleDataB.numConnections++;

                        var alpha = 1.0 - dist / data.minDistance;

                        positions[vertexpos++] = particlePositions[i * 3];
                        positions[vertexpos++] = particlePositions[i * 3 + 1];
                        positions[vertexpos++] = particlePositions[i * 3 + 2];

                        positions[vertexpos++] = particlePositions[j * 3];
                        positions[vertexpos++] = particlePositions[j * 3 + 1];
                        positions[vertexpos++] = particlePositions[j * 3 + 2];

                        colors[colorpos++] = alpha;
                        colors[colorpos++] = alpha;
                        colors[colorpos++] = alpha;

                        colors[colorpos++] = alpha;
                        colors[colorpos++] = alpha;
                        colors[colorpos++] = alpha;

                        numConnected++;
                    }
                }
            }

            linesMesh.geometry.setDrawRange(0, numConnected * 2);
            linesMesh.geometry.attributes.position.needsUpdate = true;
            pointCloud.geometry.attributes.position.needsUpdate = true;


        }

    };

})(Engine);