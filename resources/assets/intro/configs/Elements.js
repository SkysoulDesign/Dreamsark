module.exports = (function () {

    return {
        'global': [
        ],
        'comp-1': [
            require('../elements/Particles'),
            require('../elements/Skybox'),
            require('../elements/Dreamsark'),
            require('../elements/Ground'),
            require('../elements/ColoredParticles')
        ],
        'comp-2': [
            require('../elements/Ball')
        ]
    }
})();