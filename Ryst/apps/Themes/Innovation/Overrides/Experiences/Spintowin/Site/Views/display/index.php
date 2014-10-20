<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ryst</title>
  <link rel="stylesheet" href="/display/css/superslides.css">
  <link rel="stylesheet" href="/display/css/jquery.toastmessage.css" />
   <link href="http://fonts.googleapis.com/css?family=Iceland" rel="stylesheet" type="text/css">
<link href='http://fonts.googleapis.com/css?family=Orbitron:400,700' rel='stylesheet' type='text/css'>
    <style type="text/css">
* {
    -webkit-user-select: none;
    -webkit-touch-callout: none;
    -webkit-user-drag: none;
    }

    body,html {
    height: 100%;
    margin: 0;
    overflow: hidden;
    font-weight: 400;
    font-family: 'Orbitron', arial;
 
    }

    body {
    margin: 0;
    overflow: hidden;
    background:#0000cc!important;
    color:#fff;
  
    }

    #spin-btn {
    width: 100%;
    position: absolute;
    bottom: 15px;
    left: 0;
    text-align: center;
    z-index: 999;
    }	

    #winloss { color:#fff!important; }


    #wheels-glass {
    height: 319px;
    width: 711px;
    background: transparent url('/Innovation/img/wheel-glass.png') no-repeat;
    position:absolute;
    border-radius:5px;
    left:0px;
    top:0px;
    z-index:999;
    }
    #wheels {
    z-index:-1;
    margin: auto;
    top: 190px;
    left:445px;
    position:absolute;
    opacity:0.3;
    height: 419px;
    width: 711px;

    background: url('/Innovation/img/wheel-bg.png') no-repeat;
    
    }
    #output {
	z-index:-2;
	position:absolute;
	top:0;
	left:0;
	height:100%;
	width:100%;
    }
    #output canvas { height:100%!important; width: 100%; }
.container { height:100%; width:100%; }
.vignette {
background-image: -webkit-radial-gradient(50% 50%, ellipse, rgba(0,0,0,0) 40%, rgba(0,0,0,1) 100%);
background-image: radial-gradient(50% 50%, ellipse, rgba(0,0,0,0) 40%, rgba(0,0,0,1) 100%);
}
.overlay {
pointer-events: none;
position: absolute;
height: 100%;
width: 100%;
left: 0;
top: 0;
}

    #result {
    position: absolute;
    top: 0;
    width: 100%;
    text-align: center;
    font-size: 1.2em;
    }

    #wheels ul {
    list-style: none;
    margin: 0 auto;
    padding: 0;
    width:711px;
    margin-top:48px;
    border-radius:10px;
    }

    #wheels li {
    margin-top:0px;
    margin-left:30px;
    padding: 0;
    display: inline-block;
    list-style: none;
    width:211px;
    height: 212px!important;
    color: #FFC0CB;
    text-align: center;
    
    }

    #wheels li:first-child {
    margin-left:8px;
    }

    #wheels li:last-child {
    margin-left:35px;
    }

    #leds.on {
    background-position: center 0;
    }


    #player, #winner,#tap{
    position: absolute;
    margin: auto;
    top:630px;
    text-align:Center;
    width: 1018px;
    font-size:1.8em;
    text-transform:uppercase;
    z-index:9999;

    }

    #spin-btn {
    margin: auto;
    text-align: center;
    }


    #control {
    -webkit-tap-highlight-color: rgba(0,0,0,0);
    margin: auto;
    width: 274px;
    text-indent: -9999px;
    height: 100px;
    display: block;
    border: none;
    }


    .slot {
    background: url(/Innovation/img/slot-bars.png)no-repeat;
    background-position: 0 4px;
    background-size: 100%;
    }

    .motion {
    background: url(/Innovation/img/slot-bars-blur.png);
    background-size: 100%;
    }
   
    #logo {

	background: url('/Innovation/img/spin2win.png') no-repeat;
	height: 225px;
	width: 711px;
	background-size:100%;
	background-position: center right;
	position:absolute;
	margin:auto;
       top:20px;
	left:440px;
	z-index:999;
    }
    #slotwrapper{

	background:url('/Innovation/img/slotbg.png') no-repeat;
	height: 100%;
	width: 1024px;
	background-size:100%;
	background-position: center center;
	padding-top:20px;
	margin:auto;
    }
    #slotheader {
    
       margin:0 auto;
       
	width:680px;

       padding:20px;
	box-sizing:content-box;
    }
    .blue { color:rgba(157, 29, 134, 1)!important; }
    #c { 

	border-radius:30px;
	height:203px;
	width:711px;
       position:absolute;
	left:443px;
 	top:22px;
	box-shadow:0px 40px 25px 0px rgba(0,0,100, .4);
	
    }
    .num {
	
	border-radius:5px;
	background:#000;
	padding:8px;
       width:auto;
	margin-top:60px;
	display:inline-block;
	text-align:center;
	float:right;
    }
    #bet {
	margin-right:55px;
	margin-left:0px;
    }
    #credits {
	margin-right:5px;
	margin-left:0px;
    }
    </style>

</head>
<body id="">



<div id="slotwrapper">

  <div id="slotheader">

    <div id="logo"></div>
<canvas id='c'></canvas>
  </div>
<div id="player" style="display:none;"></div>
<div id="winner" style="display:none;"><b id="winloss">YOU WIN!</b><br/><p id="booth"></p></div><div id="frame"></div><div id="tap"><p>Tap Your Rystband to Play!</p></div>

<div id="wheels"><div id="wheels-glass"></div><ul><li id="slot1" class="slot"></li><li id="slot2" class="slot"></li><li id="slot3" class="slot"></li></ul>
  <div id="bet" class="num">Bet: 15</div>
  <div id="credits" class="num">Credits: 15</div>

</div>

<div id="container" class="container">
      <div id="output" class="container"></div>
      <div id="vignette" class="overlay vignette"></div>
      <div id="noise" class="overlay noise"></div>
</div>

</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="/display/bell/jquery.spritely.js" type="text/javascript"></script>
  <script src="/display/bell/jquery.backgroundPosition.js" type="text/javascript"></script>
  <script src="http://js.pusher.com/2.1/pusher.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="http://jsdo.it/akm2/fhMC/js"></script>
  <script src="/Innovation/js/light.js" type="text/javascript"></script>
  <script src="/Innovation/js/fss.js" type="text/javascript"></script>

  <script>
(function(){

  //------------------------------
  // Mesh Properties
  //------------------------------
  var MESH = {
    width: 2,
    height: 2,
    depth: 0,
    segments: 16,
    slices: 16,
    xRange: 0.7,
    yRange: 0.1,
    zRange: 1.0,
    ambient: '#555555',
    diffuse: '#FFFFFF',
    speed: 0.003
  };

  //------------------------------
  // Light Properties
  //------------------------------
  var LIGHT = {
    count: 2,
    xyScalar: 1,
    zOffset: 100,
    ambient: '#3a00ff',
    diffuse: '#000059',
    speed: 0.001,
    gravity: 1200,
    dampening: 0.95,
    minLimit: 10,
    maxLimit: null,
    minDistance: 20,
    maxDistance: 400,
    autopilot: false,
    draw: true,
    bounds: FSS.Vector3.create(),
    step: FSS.Vector3.create(
      Math.randomInRange(0.2, 1.0),
      Math.randomInRange(0.2, 1.0),
      Math.randomInRange(0.2, 1.0)
    )
  };

  //------------------------------
  // Render Properties
  //------------------------------
  var WEBGL = 'webgl';
  var CANVAS = 'canvas';
  var SVG = 'svg';
  var RENDER = {
    renderer: CANVAS
  };
  //------------------------------
  // UI Properties
  //------------------------------
  var UI = {
    show: false
  };

  //------------------------------
  // Global Properties
  //------------------------------
  var now, start = Date.now();
  var center = FSS.Vector3.create();
  var attractor = FSS.Vector3.create();
  var container = document.getElementById('container');
  var controls = document.getElementById('controls');
  var output = document.getElementById('output');
  var ui = document.getElementById('ui');
  var renderer, scene, mesh, geometry, material;
  var webglRenderer, canvasRenderer, svgRenderer;
  var gui, autopilotController;

  //------------------------------
  // Methods
  //------------------------------
  function initialise() {
    createRenderer();
    createScene();
    createMesh();
    createLights();
    addEventListeners();
    
    resize(container.offsetWidth, container.offsetHeight);
    animate();
  }

  function createRenderer() {
    webglRenderer = new FSS.WebGLRenderer();
    canvasRenderer = new FSS.CanvasRenderer();
    svgRenderer = new FSS.SVGRenderer();
    setRenderer(RENDER.renderer);
  }

  function setRenderer(index) {
    if (renderer) {
      output.removeChild(renderer.element);
    }
    switch(index) {
      case WEBGL:
        renderer = webglRenderer;
        break;
      case CANVAS:
        renderer = canvasRenderer;
        break;
      case SVG:
        renderer = svgRenderer;
        break;
    }
    renderer.setSize(container.offsetWidth, container.offsetHeight);
    output.appendChild(renderer.element);
  }

  function createScene() {
    scene = new FSS.Scene();
  }

  function createMesh() {
    scene.remove(mesh);
    renderer.clear();
    geometry = new FSS.Plane(MESH.width * renderer.width, MESH.height * renderer.height, MESH.segments, MESH.slices);
    material = new FSS.Material(MESH.ambient, MESH.diffuse);
    mesh = new FSS.Mesh(geometry, material);
    scene.add(mesh);

    // Augment vertices for animation
    var v, vertex;
    for (v = geometry.vertices.length - 1; v >= 0; v--) {
      vertex = geometry.vertices[v];
      vertex.anchor = FSS.Vector3.clone(vertex.position);
      vertex.step = FSS.Vector3.create(
        Math.randomInRange(0.2, 1.0),
        Math.randomInRange(0.2, 1.0),
        Math.randomInRange(0.2, 1.0)
      );
      vertex.time = Math.randomInRange(0, Math.PIM2);
    }
  }

  function createLights() {
    var l, light;
    for (l = scene.lights.length - 1; l >= 0; l--) {
      light = scene.lights[l];
      scene.remove(light);
    }
    renderer.clear();
    for (l = 0; l < LIGHT.count; l++) {
      light = new FSS.Light(LIGHT.ambient, LIGHT.diffuse);
      light.ambientHex = light.ambient.format();
      light.diffuseHex = light.diffuse.format();
      scene.add(light);

      // Augment light for animation
      light.mass = Math.randomInRange(0.5, 1);
      light.velocity = FSS.Vector3.create();
      light.acceleration = FSS.Vector3.create();
      light.force = FSS.Vector3.create();

      // Ring SVG Circle
      light.ring = document.createElementNS(FSS.SVGNS, 'circle');
      light.ring.setAttributeNS(null, 'stroke', light.ambientHex);
      light.ring.setAttributeNS(null, 'stroke-width', '0.5');
      light.ring.setAttributeNS(null, 'fill', 'none');
      light.ring.setAttributeNS(null, 'r', '10');

      // Core SVG Circle
      light.core = document.createElementNS(FSS.SVGNS, 'circle');
      light.core.setAttributeNS(null, 'fill', light.diffuseHex);
      light.core.setAttributeNS(null, 'r', '4');
    }
  }

  function resize(width, height) {
    renderer.setSize(width, height);
    FSS.Vector3.set(center, renderer.halfWidth, renderer.halfHeight);
    createMesh();
  }

  function animate() {
    now = Date.now() - start;
    update();
    render();
    requestAnimationFrame(animate);
  }

  function update() {
    var ox, oy, oz, l, light, v, vertex, offset = MESH.depth/2;

    // Update Bounds
    FSS.Vector3.copy(LIGHT.bounds, center);
    FSS.Vector3.multiplyScalar(LIGHT.bounds, LIGHT.xyScalar);

    // Update Attractor
    FSS.Vector3.setZ(attractor, LIGHT.zOffset);

    // Overwrite the Attractor position
    if (LIGHT.autopilot) {
      ox = Math.sin(LIGHT.step[0] * now * LIGHT.speed);
      oy = Math.cos(LIGHT.step[1] * now * LIGHT.speed);
      FSS.Vector3.set(attractor,
        LIGHT.bounds[0]*ox,
        LIGHT.bounds[1]*oy,
        LIGHT.zOffset);
    }

    // Animate Lights
    for (l = scene.lights.length - 1; l >= 0; l--) {
      light = scene.lights[l];

      // Reset the z position of the light
      FSS.Vector3.setZ(light.position, LIGHT.zOffset);

      // Calculate the force Luke!
      var D = Math.clamp(FSS.Vector3.distanceSquared(light.position, attractor), LIGHT.minDistance, LIGHT.maxDistance);
      var F = LIGHT.gravity * light.mass / D;
      FSS.Vector3.subtractVectors(light.force, attractor, light.position);
      FSS.Vector3.normalise(light.force);
      FSS.Vector3.multiplyScalar(light.force, F);

      // Update the light position
      FSS.Vector3.set(light.acceleration);
      FSS.Vector3.add(light.acceleration, light.force);
      FSS.Vector3.add(light.velocity, light.acceleration);
      FSS.Vector3.multiplyScalar(light.velocity, LIGHT.dampening);
      FSS.Vector3.limit(light.velocity, LIGHT.minLimit, LIGHT.maxLimit);
      FSS.Vector3.add(light.position, light.velocity);
    }

    // Animate Vertices
    for (v = geometry.vertices.length - 1; v >= 0; v--) {
      vertex = geometry.vertices[v];
      ox = Math.sin(vertex.time + vertex.step[0] * now * MESH.speed);
      oy = Math.cos(vertex.time + vertex.step[1] * now * MESH.speed);
      oz = Math.sin(vertex.time + vertex.step[2] * now * MESH.speed);
      FSS.Vector3.set(vertex.position,
        MESH.xRange*geometry.segmentWidth*ox,
        MESH.yRange*geometry.sliceHeight*oy,
        MESH.zRange*offset*oz - offset);
      FSS.Vector3.add(vertex.position, vertex.anchor);
    }

    // Set the Geometry to dirty
    geometry.dirty = true;
  }

  function render() {
    renderer.render(scene);

    // Draw Lights
    if (LIGHT.draw) {
      var l, lx, ly, light;
      for (l = scene.lights.length - 1; l >= 0; l--) {
        light = scene.lights[l];
        lx = light.position[0];
        ly = light.position[1];
        switch(RENDER.renderer) {
          case CANVAS:
            renderer.context.lineWidth = 0.5;
            renderer.context.beginPath();
            renderer.context.arc(lx, ly, 10, 0, Math.PIM2);
            renderer.context.strokeStyle = light.ambientHex;
            renderer.context.stroke();
            renderer.context.beginPath();
            renderer.context.arc(lx, ly, 4, 0, Math.PIM2);
            renderer.context.fillStyle = light.diffuseHex;
            renderer.context.fill();
            break;
          case SVG:
            lx += renderer.halfWidth;
            ly = renderer.halfHeight - ly;
            light.core.setAttributeNS(null, 'fill', light.diffuseHex);
            light.core.setAttributeNS(null, 'cx', lx);
            light.core.setAttributeNS(null, 'cy', ly);
            renderer.element.appendChild(light.core);
            light.ring.setAttributeNS(null, 'stroke', light.ambientHex);
            light.ring.setAttributeNS(null, 'cx', lx);
            light.ring.setAttributeNS(null, 'cy', ly);
            renderer.element.appendChild(light.ring);
            break;
        }
      }
    }
  }

  function addEventListeners() {
    window.addEventListener('resize', onWindowResize);
    container.addEventListener('click', onMouseClick);
    container.addEventListener('mousemove', onMouseMove);
  }

   //------------------------------
  // Callbacks
  //------------------------------
  function onMouseClick(event) {
    FSS.Vector3.set(attractor, event.x, renderer.height - event.y);
    FSS.Vector3.subtract(attractor, center);
    LIGHT.autopilot = !LIGHT.autopilot;
    autopilotController.updateDisplay();
  }

  function onMouseMove(event) {
    FSS.Vector3.set(attractor, event.x, renderer.height - event.y);
    FSS.Vector3.subtract(attractor, center);
  }

  function onWindowResize(event) {
    resize(container.offsetWidth, container.offsetHeight);
    render();
  }



  // Let there be light!
  initialise();

})();


var french=0;
$(document).ready(function(){(
function(e) {
var winner=0;
    e._spritely = {
        animate: function(t) {
            var n = e(t.el);
            var r = n.attr("id");
            t = e.extend(t, e._spritely.instances[r] || {});
            if (t.play_frames && !e._spritely.instances[r]["remaining_frames"]) {
                e._spritely.instances[r]["remaining_frames"] = t.play_frames + 1
            }
            if (t.type == "sprite" && t.fps) {
                var i;
                var s = function(n) {
                        var s = t.width,
                            o = t.height;
                        if (!i) {
                            i = [];
                            total = 0;
                            for (var u = 0;
                            u < t.no_of_frames; u++) {
                                i[i.length] = 0 - total;
                                total += s
                            }
                        }
                        if (t.rewind == true) {
                            if (e._spritely.instances[r]["current_frame"] <= 0) {
                                e._spritely.instances[r]["current_frame"] = i.length - 1
                            } else {
                                e._spritely.instances[r]["current_frame"] = e._spritely.instances[r]["current_frame"] - 1
                            }
                        } else {
                            if (e._spritely.instances[r]["current_frame"] >= i.length - 1) {
                                e._spritely.instances[r]["current_frame"] = 0
                            } else {
                                e._spritely.instances[r]["current_frame"] = e._spritely.instances[r]["current_frame"] + 1
                            }
                        }
                        var a = e._spritely.getBgY(n);
                        n.css("background-position", i[e._spritely.instances[r]["current_frame"]] + "px " + a);
                        if (t.bounce && t.bounce[0] > 0 && t.bounce[1] > 0) {
                            var f = t.bounce[0];
                            var l = t.bounce[1];
                            var c = t.bounce[2];
                            n.animate({
                                top: "+=" + f + "px",
                                left: "-=" + l + "px"
                            }, c).animate({
                                top: "-=" + f + "px",
                                left: "+=" + l + "px"
                            }, c)
                        }
                    };
                if (e._spritely.instances[r]["remaining_frames"] && e._spritely.instances[r]["remaining_frames"] > 0) {
                    e._spritely.instances[r]["remaining_frames"]--;
                    if (e._spritely.instances[r]["remaining_frames"] == 0) {
                        e._spritely.instances[r]["remaining_frames"] = -1;
                        delete e._spritely.instances[r]["remaining_frames"];
                        return
                    } else {
                        s(n)
                    }
                } else if (e._spritely.instances[r]["remaining_frames"] != -1) {
                    s(n)
                }
            } else if (t.type == "pan") {
                if (!e._spritely.instances[r]["_stopped"]) {
                    if (t.dir == "up") {
                        e._spritely.instances[r]["l"] = e._spritely.getBgX(n).replace("px", "");
                        e._spritely.instances[r]["t"] = e._spritely.instances[r]["t"] - (t.speed || 1) || 0
                    } else if (t.dir == "down") {
                        e._spritely.instances[r]["l"] = e._spritely.getBgX(n).replace("px", "");
                        e._spritely.instances[r]["t"] = e._spritely.instances[r]["t"] + (t.speed || 1) || 0
                    } else if (t.dir == "left") {
                        e._spritely.instances[r]["l"] = e._spritely.instances[r]["l"] - (t.speed || 1) || 0;
                        e._spritely.instances[r]["t"] = e._spritely.getBgY(n).replace("px", "")
                    } else {
                        e._spritely.instances[r]["l"] = e._spritely.instances[r]["l"] + (t.speed || 1) || 0;
                        e._spritely.instances[r]["t"] = e._spritely.getBgY(n).replace("px", "")
                    }
                    var o = e._spritely.instances[r]["l"].toString();
                    if (o.indexOf("%") == -1) {
                        o += "px "
                    } else {
                        o += " "
                    }
                    var u = e._spritely.instances[r]["t"].toString();
                    if (u.indexOf("%") == -1) {
                        u += "px "
                    } else {
                        u += " "
                    }
                    e(n).css("background-position", o + u)
                }
            }
            e._spritely.instances[r]["options"] = t;
            window.setTimeout(function() {
                e._spritely.animate(t)
            }, parseInt(1e3 / t.fps))
        },
        randomIntBetween: function(e, t) {
            return parseInt(rand_no = Math.floor((t - (e - 1)) * Math.random()) + e)
        },
        getBgY: function(t) {
            if (e.browser.msie) {
                var n = e(t).css("background-position-y") || "0"
            } else {
                var n = (e(t).css("background-position") || " ").split(" ")[1]
            }
            return n
        },
        getBgX: function(t) {
             var n = (e(t).css("background-position") || " ").split(" ")[0]
            
            return n
        },
        get_rel_pos: function(e, t) {
            var n = e;
            if (e < 0) {
                while (n < 0) {
                    n += t
                }
            } else {
                while (n > t) {
                    n -= t
                }
            }
            return n
        }
    };
    e.fn.extend({
        spritely: function(t) {
            var t = e.extend({
                type: "sprite",
                do_once: false,
                width: null,
                height: null,
                fps: 12,
                no_of_frames: 2,
                stop_after: null
            }, t || {});
            var n = e(this).attr("id");
            if (!e._spritely.instances) {
                e._spritely.instances = {}
            }
            if (!e._spritely.instances[n]) {
                e._spritely.instances[n] = {
                    current_frame: -1
                }
            }
            e._spritely.instances[n]["type"] = t.type;
            e._spritely.instances[n]["depth"] = t.depth;
            t.el = this;
            t.width = t.width || e(this).width() || 100;
            t.height = t.height || e(this).height() || 100;
            var r = function() {
                    return parseInt(1e3 / t.fps)
                };
            if (!t.do_once) {
                window.setTimeout(function() {
                    e._spritely.animate(t)
                }, r(t.fps))
            } else {
                e._spritely.animate(t)
            }
            return this
        },
        sprite: function(t) {
            var t = e.extend({
                type: "sprite",
                bounce: [0, 0, 1e3]
            }, t || {});
            return e(this).spritely(t)
        },
        pan: function(t) {
            var t = e.extend({
                type: "pan",
                dir: "left",
                continuous: true,
                speed: 1
            }, t || {});
            return e(this).spritely(t)
        },
        flyToTap: function(t) {
            var t = e.extend({
                el_to_move: null,
                type: "moveToTap",
                ms: 1e3,
                do_once: true
            }, t || {});
            if (t.el_to_move) {
                e(t.el_to_move).active()
            }
            if (e._spritely.activeSprite) {
                if (window.Touch) {
                    e(this)[0].ontouchstart = function(t) {
                        var n = e._spritely.activeSprite;
                        var r = t.touches[0];
                        var i = r.pageY - n.height() / 2;
                        var s = r.pageX - n.width() / 2;
                        n.animate({
                            top: i + "px",
                            left: s + "px"
                        }, 1e3)
                    }
                } else {
                    e(this).click(function(t) {
                        var n = e._spritely.activeSprite;
                        e(n).stop(true);
                        var r = n.width();
                        var i = n.height();
                        var s = t.pageX - r / 2;
                        var o = t.pageY - i / 2;
                        n.animate({
                            top: o + "px",
                            left: s + "px"
                        }, 1e3)
                    })
                }
            }
            return this
        },
        isDraggable: function(t) {
            if (!e(this).draggable) {
                return this
            }
            var t = e.extend({
                type: "isDraggable",
                start: null,
                stop: null,
                drag: null
            }, t || {});
            var n = e(this).attr("id");
            e._spritely.instances[n].isDraggableOptions = t;
            e(this).draggable({
                start: function() {
                    var t = e(this).attr("id");
                    e._spritely.instances[t].stop_random = true;
                    e(this).stop(true);
                    if (e._spritely.instances[t].isDraggableOptions.start) {
                        e._spritely.instances[t].isDraggableOptions.start(this)
                    }
                },
                drag: t.drag,
                stop: function() {
                    var t = e(this).attr("id");
                    e._spritely.instances[t].stop_random = false;
                    if (e._spritely.instances[t].isDraggableOptions.stop) {
                        e._spritely.instances[t].isDraggableOptions.stop(this)
                    }
                }
            });
            return this
        },
        active: function() {
            e._spritely.activeSprite = this;
            return this
        },
        activeOnClick: function() {
            var t = e(this);
            if (window.Touch) {
                t[0].ontouchstart = function(n) {
                    e._spritely.activeSprite = t
                }
            } else {
                t.click(function(n) {
                    e._spritely.activeSprite = t
                })
            }
            return this
        },
        spRandom: function(t) {
            var t = e.extend({
                top: 50,
                left: 50,
                right: 290,
                bottom: 320,
                speed: 4e3,
                pause: 0
            }, t || {});
            var n = e(this).attr("id");
            if (!e._spritely.instances[n].stop_random) {
                var r = e._spritely.randomIntBetween;
                var i = r(t.top, t.bottom);
                var s = r(t.left, t.right);
                e("#" + n).animate({
                    top: i + "px",
                    left: s + "px"
                }, t.speed)
            }
            window.setTimeout(function() {
                e("#" + n).spRandom(t)
            }, t.speed + t.pause);
            return this
        },
        makeAbsolute: function() {
            return this.each(function() {
                var t = e(this);
                var n = t.position();
                t.css({
                    position: "absolute",
                    marginLeft: 0,
                    marginTop: 0,
                    top: n.top,
                    left: n.left
                }).remove().appendTo("body")
            })
        },
        spSet: function(t, n) {
            var r = e(this).attr("id");
            e._spritely.instances[r][t] = n;
            return this
        },
        spGet: function(t, n) {
            var r = e(this).attr("id");
            return e._spritely.instances[r][t]
        },
        spStop: function(t) {
            e(this).each(function() {
                var n = e(this).attr("id");
                e._spritely.instances[n]["_last_fps"] = e(this).spGet("fps");
                e._spritely.instances[n]["_stopped"] = true;
                e._spritely.instances[n]["_stopped_f1"] = t;
                if (e._spritely.instances[n]["type"] == "sprite") {
                    e(this).spSet("fps", 0)
                }
                if (t) {
                    var r = e._spritely.getBgY(e(this));
                    e(this).css("background-position", "0 " + r)
                }
            });
            return this
        },
        spStart: function() {
            e(this).each(function() {
                var t = e(this).attr("id");
                var n = e._spritely.instances[t]["_last_fps"] || 12;
                e._spritely.instances[t]["_stopped"] = false;
                if (e._spritely.instances[t]["type"] == "sprite") {
                    e(this).spSet("fps", n)
                }
            });
            return this
        },
        spToggle: function() {
            var t = e(this).attr("id");
            var n = e._spritely.instances[t]["_stopped"] || false;
            var r = e._spritely.instances[t]["_stopped_f1"] || false;
            if (n) {
                e(this).spStart()
            } else {
                e(this).spStop(r)
            }
            return this
        },
        fps: function(t) {
            e(this).each(function() {
                e(this).spSet("fps", t)
            });
            return this
        },
        spSpeed: function(t) {
            e(this).each(function() {
                e(this).spSet("speed", t)
            });
            return this
        },
        spRelSpeed: function(t) {
            e(this).each(function() {
                var n = e(this).spGet("depth") / 100;
                e(this).spSet("speed", t * n)
            });
            return this
        },
        spChangeDir: function(t) {
            e(this).each(function() {
                e(this).spSet("dir", t)
            });
            return this
        },
        spState: function(t) {
            e(this).each(function() {
                var r = (t - 1) * e(this).height() + "px";
                var i = e._spritely.getBgX(e(this));
                var s = i + " -" + r;
                e(this).css("background-position", s)
            });
            return this
        },
        lockTo: function(t, n) {
            e(this).each(function() {
                var r = e(this).attr("id");
                e._spritely.instances[r]["locked_el"] = e(this);
                e._spritely.instances[r]["lock_to"] = e(t);
                e._spritely.instances[r]["lock_to_options"] = n;
                window.setInterval(function() {
                    if (e._spritely.instances[r]["lock_to"]) {
                        var t = e._spritely.instances[r]["locked_el"];
                        var n = e._spritely.instances[r]["lock_to"];
                        var i = e._spritely.instances[r]["lock_to_options"];
                        var s = i.bg_img_width;
                        var o = n.height();
                        var u = e._spritely.getBgY(n);
                        var a = e._spritely.getBgX(n);
                        var f = parseInt(a) + parseInt(i["left"]);
                        var l = parseInt(u) + parseInt(i["top"]);
                        f = e._spritely.get_rel_pos(f, s);
                        e(t).css({
                            top: l + "px",
                            left: f + "px"
                        })
                    }
                }, n.interval || 20)
            });
            return this
        }
    })

    function r(e) {
        e = e.replace(/left|top/g, "0px");
        e = e.replace(/right|bottom/g, "100%");
        e = e.replace(/([0-9\.]+)(\s|\)|$)/g, "$1px$2");
        var t = e.match(/(-?[0-9\.]+)(px|\%|em|pt)\s(-?[0-9\.]+)(px|\%|em|pt)/);
        return [parseFloat(t[1], 10), t[2], parseFloat(t[3], 10), t[4]]
    }
    if (!document.defaultView || !document.defaultView.getComputedStyle) {
        var t = e.css;
        e.css = function(e, n, r) {
            if (n === "background-position") {
                n = "backgroundPosition"
            }
            if (n !== "backgroundPosition" || !e.currentStyle || e.currentStyle[n]) {
                return t.apply(this, arguments)
            }
            var i = e.style;
            if (!r && i && i[n]) {
                return i[n]
            }
            return t(e, "backgroundPositionX", r) + " " + t(e, "backgroundPositionY", r)
        }
    }
    var n = e.fn.animate;
    e.fn.animate = function(e) {
        if ("background-position" in e) {
            e.backgroundPosition = e["background-position"];
            delete e["background-position"]
        }
        if ("backgroundPosition" in e) {
            e.backgroundPosition = "(" + e.backgroundPosition
        }
        return n.apply(this, arguments)
    };
    e.fx.step.backgroundPosition = function(t) {
        if (!t.bgPosReady) {
            var n = e.css(t.elem, "backgroundPosition");
            if (!n) {
                n = "0px 0px"
            }
            n = r(n);
            t.start = [n[0], n[2]];
            var i = r(t.end);
            t.end = [i[0], i[2]];
            t.unit = [i[1], i[3]];
            t.bgPosReady = true
        }
        var s = [];
        s[0] = (t.end[0] - t.start[0]) * t.pos + t.start[0] + t.unit[0];
        s[1] = (t.end[1] - t.start[1]) * t.pos + t.start[1] + t.unit[1];
        t.elem.style.backgroundPosition = s[0] + " " + s[1]
    }
})(jQuery);

var debug = '';
if (!debug) {
    var spinSnd = new Audio("/display/bell/spin.mp3");
    spinSnd.addEventListener('ended', function() {
        this.currentTime = 0;
        this.play();
    }, false);
    var stopSnd = new Audio("/display/bell/stop.mp3");
    var winSnd = new Audio("/display/bell/win.mp3");
}

var credits = 100,
    score = 0,
    bet = 1,
    completed = 0,
    imgHeight = 600,
    posArr = [0, 150, 300, 450, 600, 750, 900, 1050];
var win = [];
win[0] = win[0] = win[0] = 1;
win[150] = win[150] = win[150] = 2;
win[300] = win[300] = win[300] = 3;
win[450] = win[450] = win[450] = 4;
win[600] = win[600] = win[600] = 5;
win[750] = win[750] = win[750] = 6;
win[900] = win[900] = win[900] = 7;
win[1050] = win[1050] = win[1050] = 8;

function Slot(el, max, step) {
    this.speed = 0;
    this.step = step;
    this.si = null;
    this.el = el;
    this.maxSpeed = max;
    this.pos = null;
    $(el).pan({
        fps: 30,
        dir: 'down'
    });
    $(el).spStop();
}
Slot.prototype.start = function() {
    var _this = this;
    $(_this.el).addClass('motion');
    $(_this.el).spStart();
    _this.si = window.setInterval(function() {
        if (_this.speed < _this.maxSpeed) {
            _this.speed += _this.step;
            $(_this.el).spSpeed(_this.speed);
        }
    }, 100);
};
Slot.prototype.stop = function() {
    var _this = this,
        limit = 30;
    clearInterval(_this.si);
    _this.si = window.setInterval(function() {
        if (_this.speed > limit) {
            _this.speed -= _this.step;
            $(_this.el).spSpeed(_this.speed);
        }
        if (_this.speed <= limit) {
            _this.finalPos(_this.el);
            $(_this.el).spSpeed(0);
            $(_this.el).spStop();
            clearInterval(_this.si);
            $(_this.el).removeClass('motion');
            _this.speed = 0;
        }
    }, 100);
};
Slot.prototype.finalPos = function() {
    var el = this.el,
        el_id, pos, posMin = 600,
        best, bgPos, i, j, k;
    el_id = $(el).attr('id');
    pos = document.getElementById(el_id).style.backgroundPosition;
    pos = pos.split(' ')[1];
    pos = parseInt(pos, 10);
    for (i = 0; i < posArr.length; i++) {
        for (j = 0;; j++) {
            k = posArr[i] + (imgHeight * j);
            if (k > pos) {
                if ((k - pos) < posMin) {
                    posMin = k - pos;
                    best = k;
                    this.pos = posArr[i];
                }
                break;
            }
        }
    }
   best += imgHeight ;
    console.log("is winner? : " + winner);
    if (winner == "winner") {
var H = 5;
	$('#c').animate({boxShadow: '0px 40px 25px 0px rgba(56, 533, 255, 1)'}, 'fast');	 
        bgPos = "0 -200px";
	 //french
	if (french==1) {
	 $("#winloss").html("Vous avez gagn&#233;!");
        $("#booth").html("<small>Veuiller r&#233;clamer votre prix au kiosque Samsung!!</small>");
	} else {
	 //english
	$("#winloss").html("You WIN!");
       $("#booth").html("<br/><small>Please collect your prize at the Samsung booth.</small>");
	}
    } 
    if ( winner == "prize" ) {
        bgPos = "0 -500px";
	if (french==1) {
        //french
	 $("#winloss").html("Vous avez gagn&#233;!");
        $("#booth").html("<small>Veuiller r&#233;clamer votre prix &#224; la table Bell !!</small>");
	} else {
        //english
	 $("#winloss").html("You WIN!");
        $("#booth").html("<small>Please collect your prize at the Bell prize table.</small>");
	}


    } 
    if ( winner == "loser" ) {

	if (french==1) {
  	// french
	 $("#winloss").html("D&#233;sol&#233;, essayer de nouveau");
	 $("#booth").html("");
	} else {
  	// english
	 $("#winloss").html("We're Sorry<br>Please try again later.");
	 $("#booth").html("");
	}
        bgPos = "0 " + ( Math.floor(Math.random() * (0 - -690 + 1)) + -690 ) + "px";
    }
    console.log("final pos:" + bgPos);
    stopSnd.currentTime = 0;

    $(el).animate({
        backgroundPosition: "(" + bgPos + ")"
    }, {
        duration: 200,
        complete: function() {
            console.log("set :" + bgPos);
            completed++;
            console.log(completed);
            stopSnd.play();
        }
    });
};
Slot.prototype.reset = function() {
    var el_id = $(this.el).attr('id');
    $._spritely.instances[el_id].t = 0;
    $(this.el).css('background-position', '0px 4px');
    this.speed = 0;
    completed = 0;
      
};

var a = new Slot('#slot1', 25, 1),
    b = new Slot('#slot2', 45, 2),
    c = new Slot('#slot3', 75, 3);



function spin(isWinner) {
winner=isWinner;
$('#winner').hide();
console.log(winner);
var spinTime;

	if(isWinner) { 
	 // spinTime = 2130;
	} else {
	  spinTime = 840;	
	}
	     $("#credits").html("Credits: 0");
	     $("#bet").addClass("blue");
            a.start();
            b.start();
            c.start();

            x = window.setInterval(function() {
                if (a.speed >= a.maxSpeed && b.speed >= b.maxSpeed && c.speed >= c.maxSpeed) {
                    window.clearInterval(x);

 		window.setTimeout(function() {
		
	
 		console.log('stop!');

  	        spinSnd.currentTime = 0;
  	        spinSnd.pause();
               
 	        a.stop();
       	 b.stop();
       	 c.stop();
				   window.setTimeout(function() {
					 

  	               		   $('#winner').fadeIn('fast');
			 		  
					if (isWinner=="winner") {
					  console.log('winner!');

		  $('#c').animate({ boxShadow : "0px 40px 5px 30px rgba(157,29,134,.7)" },'fast'); 
		  $('#c').animate({ boxShadow : "0px 40px 55px 30px rgba(157,29,134,.6)" },'fast');
		  $('#c').animate({ boxShadow : "0px 40px 5px 30px rgba(157,29,134,.7)" },'fast'); 
		  $('#c').animate({ boxShadow : "0px 40px 55px 30px rgba(157,29,134,.6)" },'fast');
		  $('#c').animate({ boxShadow : "0px 40px 5px 30px rgba(157,29,134,.7)" },'fast'); 
		  $('#c').animate({ boxShadow : "0px 40px 55px 30px rgba(157,29,134,.6)" },'fast');
		  $('#c').animate({ boxShadow : "0px 40px 5px 30px rgba(157,29,134,.7)" },'fast'); 
		  $('#c').animate({ boxShadow : "0px 40px 55px 30px rgba(157,29,134,.6)" },'fast');
		  $('#c').animate({ boxShadow : "0px 40px 5px 30px rgba(157,29,134,.7)" },'fast'); 
		  $('#c').animate({ boxShadow : "0px 40px 55px 30px rgba(157,29,134,.6)" },'fast');
		  $('#c').animate({ boxShadow : "0px 40px 5px 30px rgba(157,29,134,.7)" },'fast'); 
		  $('#c').animate({ boxShadow : "0px 40px 55px 30px rgba(157,29,134,.6)" },'fast');
		  $('#c').animate({ boxShadow : "0px 40px 5px 30px rgba(157,29,134,.7)" },'fast'); 
		  $('#c').animate({ boxShadow : "0px 40px 55px 30px rgba(157,29,134,.6)" },'fast');
		  $('#c').animate({ boxShadow : "0px 40px 5px 30px rgba(157,29,134,.7)" },'fast'); 
		  $('#c').animate({ boxShadow : "0px 40px 55px 30px rgba(157,29,134,.6)" },'fast');

  	                		  winSnd.play();
  	              		} 
				  }, 2130	);



				   window.setTimeout(function() {
					a.reset();
       				b.reset();
       				c.reset();			
					$('#winner').fadeOut();
					$('#wheels').fadeOut();
                                 // location.reload();

 					$("body").fadeOut(1000, location.reload());
				  }, 6500);

  	        
		
            }, spinTime);


                }
            }, 100);
		spinSnd.play();
           




}

function showName(data) {

	if (french==1) {
         // french
         $('#player').html(data.attendee.first_name + ', Pr&#233;parez-vous &#224; jouer!');
	} else {
         //english
         $('#player').html(data.attendee.first_name + ', Get Ready!');
	}

     $('#player').fadeIn('fast');


            window.setTimeout(function() {
                           
                     $('#player').hide();
            }, 3500);
}

     Pusher.log = function(message) {
      if (window.console && window.console.log) {
        window.console.log(message);
      }
    };
			   
	var pusher = new Pusher("<?php echo $experience->{'pusher.public'}; ?>");
	var channel = pusher.subscribe("<?php echo $experience->{'pusher.channel'}; ?>");

        channel.bind('noAttendee', function(data){
	       $('#tap').fadeOut();
              $('#player').html(' You need to register your band to be able to play!');
              $('#player').fadeIn('fast');

              window.setTimeout(function() {             
                    location.reload()
            }, 3500);
        });

    	channel.bind('play', function(data) {
		 $('#tap').fadeOut();

	        showName(data);
               setTimeout(function () {
		 $('#player').fadeOut('fast');
		 $('#wheels').fadeIn('fast').css('opacity','1');
		
                spin(data.game.status); 

		  $('#c').animate({ boxShadow : "0px 40px 15px 30px rgba(58,0,255,.6)" },'slow'); 
		  $('#c').animate({ boxShadow : "0px 40px 35px 30px rgba(58,0,255,.7)" },'slow');
		  $('#c').animate({ boxShadow : "0px 40px 15px 30px rgba(58,0,255,.6)" },'slow'); 
		  $('#c').animate({ boxShadow : "0px 40px 35px 30px rgba(58,0,255,.7)" },'slow');
		  $('#c').animate({ boxShadow : "0px 40px 15px 30px rgba(58,0,255,.6)" },'slow'); 
		  $('#c').animate({ boxShadow : "0px 40px 35px 30px rgba(58,0,255,.7)" },'slow');

               }, 4000);
	
		           

    	    });
        });
  </script>
</body>
</html>

