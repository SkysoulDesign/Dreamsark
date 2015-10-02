global.jQuery = require("jquery");
global.$ = global.jQuery;
var td = require('throttle-debounce');

/**
 * Prototype
 */
$(document).ready(function () {

    $('.ui.dropdown:not(.no-default)').dropdown();
    $('.ui.form .ui.checkbox').checkbox();
    $('.ui.rating').rating();
    $('.ui.embed').embed();
    $('.tabular.menu .item, #menu .item').tab();
    $('.dimmable.image').dimmer({
        on: 'hover'
    });

    $('#translation-language').dropdown({
        onChange: function ($value, text, $choice) {

            var pathArray = window.location.pathname.split('/');

            var group = pathArray[3];

            if (!group) {
                group = '';
            }

            window.location.href = 'http://dreamsark.dev/translation/' + $value + '/' + group;

        }
    });

    $('#translation-group').dropdown({
        onChange: function ($value, text, $choice) {

            var pathArray = window.location.pathname.split('/');

            var language = pathArray[2];

            if (!language) {
                language = 'all'
            }

            window.location.href = 'http://dreamsark.dev/translation/' + language + '/' + $value;


        }
    });

    $('.translation-value input').keyup(td.debounce(250, function () {

        $parrent = $(this).parent();


        $name = $(this).attr('data-name');

        var $values = {};
        $values[$name] = this.value;
        $values['_token'] = $(this).attr('data-token');

        $.ajax({
                url: $(this).attr('data-action'),
                method: 'POST',
                data: $values,
                beforeSend: function () {
                    $parrent.addClass('loading');
                }
            })
            .done(function (data) {
                if (data.status == 1) {
                    $parrent.removeClass('loading');
                }
            });

    }));

    $('#translation-language-modal')
        .modal({
            blurring: true,
            closable: false,
            onApprove: function () {
                $('#translation-new-language-form').submit();
            }
        })
        .modal('attach events', '#translation-new-language', 'show')

    $('#reportModal')
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




