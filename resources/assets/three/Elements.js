module.exports = function (name) {

    // Require all of the scripts in the elements directory
    var elements = require('bulk-require')(__dirname, ['elements/**/*.js']).elements;
    var element = elements[name].object();

    return {
        element: element,
        get: function(){
            return this.element;
        },
        scene: function(scene){
            scene.add(this.element);
            return this;
        }
    };

};