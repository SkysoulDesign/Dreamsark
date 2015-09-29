global.jQuery = require("jquery");
global.$ = global.jQuery;

/**
 * Prototype
 */
$(document).ready(function () {


    $('.ui.dropdown').dropdown();
    $('.ui.form .ui.checkbox').checkbox();
    $('.ui.rating').rating();
    $('.ui.embed').embed();
    $('.tabular.menu .item').tab();
    $('.dimmable.image').dimmer({
        on:'hover'
    });

});




