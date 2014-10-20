<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Rystband-TV Autoshow Demo</title>
  <link rel="stylesheet" href="/display/css/superslides.css">
  <link rel="stylesheet" href="/display/css/jquery.toastmessage.css" />
   <link href="http://fonts.googleapis.com/css?family=Iceland" rel=
    "stylesheet" type="text/css">
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
    font-family: iceland,verdana;
    }

    body {
    margin: 0;
    overflow: hidden;
    }

    #spin-btn {
    width: 100%;
    position: absolute;
    bottom: 15px;
    left: 0;
    text-align: center;
    z-index: 999;
    }


    #wheels {
    position: absolute;
    margin: auto;
    top: 27%;
    right:20px;
    height: 160px;
    width: 50%;
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
    }

    #wheels li {
    border-radius:20px;
    border:5px solid #000;
    margin: auto;
    padding: 0;
    display: inline-block;
    list-style: none;
    width: 32%;
    height: 250px;
    color: #FFC0CB;
    text-align: center;
    margin-left:5px;
    }



    #leds.on {
    background-position: center 0;
    }

    #winner, #player {
    background: rgba(0,0,0,0.8);
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    text-align: center;
    font-size: 3em;
    color: #fff;
    z-index: 9999;
    line-height: 100%;
    }

    #player {
        padding-top: 30%;
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

    .start {
    background: url(/display/spin/btn.png) no-repeat;
    background-position: center 0;
    }

    .start.pressed {
    background: url(/display/spin/btn.png) no-repeat;
    background-position: center -100px;
    }

 

    .reset {
    background: url(/display/spin/btn.png) no-repeat;
    background-position: center -400px;
    }

    .reset.pressed {
    background: url(/display/spin/btn.png) no-repeat;
    background-position: center -500px;
    }

    .start:disabled {
    background: url(/display/spin/btn.png) no-repeat;
    background-position: center -100px;
    }

    .stop:disabled {
    background: url(/display/spin/btn.png) no-repeat;
    background-position: center -100px;
    }

    .reset:disabled {
    background: url(/display/spin/btn.png) no-repeat;
    background-position: center -500px;
    }

    .slot {
    background: #fff url(/display/spin/bars.png);
    background-position: 0 4px;
    background-size: 100%;
    }

    .motion {
    background: #fff url(/display/spin/bars-blur.png);
    background-size: 100%;
    }

    </style>

</head>
<body id="car2">
<div id="player" style="display:none;"><b style="display:block;padding-top:20%;color:#fff;">YOU WIN!</b></div>
<div id="winner" style="display:none;"><b style="display:block;padding-top:20%;color:#fff;">YOU WIN!</b></div><div id=frame></div><div id=wheels><ul><li id=slot1 class=slot></li><li id=slot2 class=slot></li><li id=slot3 class=slot></li></ul></div>


 <script src="/jquery/core/jquery-2.0.3.min.js" type="text/javascript"></script>
  <script src="/display/spin/jquery.spritely.js" type="text/javascript"></script>
  <script src="/display/spin/jquery.backgroundPosition.js" type="text/javascript"></script>
  <script src="http://js.pusher.com/2.1/pusher.min.js" type="text/javascript"></script>


  <script>
$(document).ready(function(){(
function(e) {
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
    var spinSnd = new Audio("/display/spin/spin.mp3");
    spinSnd.addEventListener('ended', function() {
        this.currentTime = 0;
        this.play();
    }, false);
    var stopSnd = new Audio("/display/spin/stop.mp3");
    var winSnd = new Audio("/display/spin/win.mp3");
}
$('#control').bind('touchstart', function() {
    if (winner == 0) {
        $(this).addClass('pressed');
    }
});
$('#control').bind('touchend', function() {
    if (winner == 0) {
        $(this).removeClass('pressed');
    }
});
var winner = 0,
    credits = 100,
    score = 0,
    bet = 1,
    completed = 0,
    imgHeight = 1200,
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
        el_id, pos, posMin = 2000000000,
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
    best += imgHeight + 4;
    if (winner == 1) {
        bgPos = "0 " + 590 + "px";
    } else {
        bgPos = "0 " + best + "px";
    }
    console.log(bgPos);
    stopSnd.currentTime = 0;
    $(el).animate({
        backgroundPosition: "(" + bgPos + ")"
    }, {
        duration: 200,
        complete: function() {
            console.log(bgPos);
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
var spinTime;
	if(isWinner) { 
	  spinTime = 2130;
	} else {
	  spinTime = 840;	
	}
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

  	              		if (isWinner=="winner") {
  	               		   $('#winner').fadeIn('fast');
			 		   console.log('winner!');
  	                		  winSnd.play();
  	              		}
				  }, 600);

				   window.setTimeout(function() {
					a.reset();
       				b.reset();
       				c.reset();			
					$('#winner').hide();
				  }, 4500);

  	        
		
            }, spinTime);


                }
            }, 100);
		spinSnd.play();
           




}

function showName(data) {
        
     $('#player').html(data.attendee.first_name + ', Get Ready to Play!');
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

    	channel.bind('play', function(data) {
	           showName(data);
               setTimeout(function () {
                spin(data.game.status);   
               }, 4000);

		           

    	    });
        });
  </script>

</body>
</html>

