var scene = require("scene");
var App;
(function (App) {
    var Greeter = (function () {
        function Greeter(message) {
            this.greeting = scene;
        }
        Greeter.prototype.greet = function () {
            return "Hello, " + this.greeting;
        };
        return Greeter;
    })();
})(App || (App = {}));
//# sourceMappingURL=app.js.map