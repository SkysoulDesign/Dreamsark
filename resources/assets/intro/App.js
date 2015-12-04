/**
 * Caption
 *
 * a = {}.active
 * e = Engine
 * E = Engine.elements
 * c = Configs
 */

/**
 * Set Three Js
 */
global.THREE = require('THREE');
global.dat = require('dat-gui');

/**
 * Set Configs
 */
global.Configs = require('./Config');

/**
 * Get Engine
 */
global.Engine = {};
global.Engine.core = require('./Engine');
global.Engine.core = require('./Engine');

var trigger = document.querySelector('#trigger');
    trigger.addEventListener('click', Engine.start);