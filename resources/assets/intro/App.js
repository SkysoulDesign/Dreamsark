/**
 * Caption
 *
 * a = {}.active
 * e = Engine
 * E = Engine.elements
 * c = Configs
 */

/**
 * Set External Dependencies
 */
THREE = require('THREE');

/**
 * Get Engine
 */
Engine = {};
Engine = require('./Engine');
Engine.init();

var start = function () {
    Engine.start(Engine)
};

var trigger = document.querySelector('#trigger');
trigger.addEventListener('click', start, false);