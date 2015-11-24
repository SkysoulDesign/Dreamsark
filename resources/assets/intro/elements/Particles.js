module.exports = (function () {

    var max    = 10;
    var radius = 10;

    return {
        name: 'particles',
        create: function (e) {

            var map = e.loader.l('lib/point-1.png');

            var material = new THREE.PointsMaterial({
                map: map,
                size: 15
            });

            var segments = 6;

            var circleGeometry = new THREE.CircleGeometry(radius, segments, 11);

            var particles = new THREE.BufferGeometry();

            var vertices = new Float32Array(max * 3);

            for (var i = 0; i < max; i++) {

                var x = Math.random() * radius - radius / 2;
                var y = Math.random() * radius - radius / 2;
                var z = Math.random() * radius - radius / 2;

                vertices[i * 3]     = x;
                vertices[i * 3 + 1] = y;
                vertices[i * 3 + 2] = z;
            }

            particles.addAttribute('position', new THREE.BufferAttribute(vertices, 3).setDynamic(true));

            var pointsMesh = new THREE.Points(particles);

            var lineGeometry = new THREE.BufferGeometry();
            lineGeometry.addAttribute('position', new THREE.BufferAttribute(vertices, 3).setDynamic(true));
            //lineGeometry.computeBoundingSphere();

            var linesMesh = new THREE.LineSegments(lineGeometry);

            return e.helpers.group(pointsMesh, linesMesh);

        },

        share: function (e) {
            return {
                max: max,
                radius: radius
            }
        }

    }

})();