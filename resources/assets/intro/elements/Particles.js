module.exports = (function () {

    var maxPoints     = 100;
    var radius        = 200;
    var particlesData = [];


    /**
     * Create Points
     * @type {{max: number, geometry: THREE.BufferGeometry, vertices: Float32Array, create: points.create}}
     */
    var points = {
        geometry: new THREE.BufferGeometry(),
        vertices: new Float32Array(maxPoints * 3),
        create: function () {
            return new THREE.Points(this.geometry);
        }
    };

    /**
     * Create Connection Lines
     * @type {{geometry: THREE.BufferGeometry, colors: Float32Array, vertices: Float32Array, create: lines.create}}
     */
    var lines = {
        geometry: new THREE.BufferGeometry(),
        colors: new Float32Array(maxPoints * 3),
        vertices: new Float32Array((maxPoints * maxPoints) * 3),
        material: function () {
            return new THREE.LineBasicMaterial({color: 0xffffff, opacity: 1, linewidth: 3});
        },
        create: function () {
            return new THREE.LineSegments(this.geometry, this.material());
        }
    };

    return {
        name: 'particles',
        create: function (e) {

            var group = e.helpers.group();

            /**
             * Add Vertices to Points
             */
            for (var i = 0; i < maxPoints; i++) {

                var x = Math.random() * radius - radius / 2;
                var y = Math.random() * radius - radius / 2;
                var z = Math.random() * radius - radius / 2;

                points.vertices[i * 3]     = x;
                points.vertices[i * 3 + 1] = y;
                points.vertices[i * 3 + 2] = z;

                particlesData.push({
                    velocity: new THREE.Vector3(-1 + Math.random() * 2, -1 + Math.random() * 2, -1 + Math.random() * 2),
                    connections: 0
                });

            }

            /**
             * Add Position Attribute to the Geometry
             */
            var PointPositionAttribute = new THREE.BufferAttribute(points.vertices, 3).setDynamic(true);
            points.geometry.addAttribute('position', PointPositionAttribute);

            /**
             * Add Position Attribute to the Geometry
             */
            var LinePositionAttribute = new THREE.BufferAttribute(lines.vertices, 3).setDynamic(true),
                LineColorAttribute    = new THREE.BufferAttribute(lines.colors, 3).setDynamic(true);

            lines.geometry.addAttribute('position', LinePositionAttribute);
            lines.geometry.addAttribute('color', LineColorAttribute);

            return group.add(points.create(), lines.create());

        },

        share: function (e) {
            return {
                maxPoints: 100,
                minDistance: 50,
                radius: 10,
                points: points,
                lines: lines,
                particlesData: particlesData
            }
        }

    }

})();