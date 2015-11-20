/**
 * Set Three Js
 */
global.THREE = require('THREE');

/**
 * Set Configs
 */
global.Configs = require('./Config');

/**
 * Get Engine
 */
global.Engine = {
    status: {
        loading: true
    }
};
global.Engine.core = require('./Engine').render();

//
//var scene = new THREE.Scene();
//var camera = require('./modules/Camera');
//
//var renderer = new THREE.WebGLRenderer();
//renderer.setSize(window.innerWidth, window.innerHeight);
//document.body.appendChild(renderer.domElement);
//
//var geometry = new THREE.BoxGeometry(1, 1, 1);
//var material = new THREE.MeshBasicMaterial({ color:0x00ff00 });
//var cube = new THREE.Mesh(geometry, material);
//scene.add(cube);
//
//camera.position.z = 5;
//
//var render = function () {
//    requestAnimationFrame(render);
//
//    cube.rotation.x += 0.1;
//    cube.rotation.y += 0.1;
//
//    renderer.render(scene, camera);
//};
//
//render();

