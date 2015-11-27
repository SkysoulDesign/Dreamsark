module.exports = (function (e) {

    return {

        setup: function (data, E, ex) {


            var points = e.helpers.group();

            var lastPoint = null;

            for (var i = 0; i < 4; i++) {

                var point = E.point.clone();

                point.position.copy(ex.point.position);
                point.position.x += 12;
                point.position.y += 12;
                point.position.z -= 10;

                points.add(point);
            }

            e.scene.a.add(points);

            e.plugins.OrbitControls.instance.enabled = false;

        },

        animation: function (data, E) {

        }

    };

})(Engine);