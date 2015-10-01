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
    $('.tabular.menu .item, #menu .item').tab();
    $('.dimmable.image').dimmer({
        on: 'hover'
    });



    $('.ui.modal')
        .modal({
            blurring: true,
            closable: false,
            onShow: function () {
                $('#urlAddress').val(window.location.href)
            },
            onDeny: function () {

            },
            onApprove: function () {
                $('#reportForm').submit();
            }
        })
        .modal('attach events', '#showReport', 'show')

});




