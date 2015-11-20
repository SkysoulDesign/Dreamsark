module.exports = function (e) {

    return e.helpers = {
        init: function () {

            for (var i = 0; i < arguments.length; i++) {
                arguments[i].init();
            }

        },

        set: function (object, closure) {
            closure.call(object, closure);
        },

        appendTo: function (element, domElement) {
            document.getElementById(element).appendChild(domElement)
        },

        timeout: function (time, closure) {
            setTimeout(function () {
                closure.call()
            }, time);
        }
    }

}(Engine);