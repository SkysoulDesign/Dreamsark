var App;
(function (App) {
    var Greeter = (function () {
        function Greeter(message) {
        }
        Greeter.prototype.greet = function () {
            return "Hello, " + this.greeting;
        };
        return Greeter;
    })();
})(App || (App = {}));
//# sourceMappingURL=tsc.js.map