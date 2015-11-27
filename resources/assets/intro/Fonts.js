module.exports = (function (e) {

    // Require all of the scripts in the elements directory
    var fonts = require('bulk-require')(__dirname, ['fonts/**/*.js']).fonts;

    return e.fonts = fonts;

})(Engine);