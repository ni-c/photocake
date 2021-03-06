// MooTools: the javascript framework.
// Load this file's selection again by visiting: http://mootools.net/more/8997a53f2c7f86e686c31c4a821b0834
// Or build this file again with packager using: packager build More/Fx.Scroll More/Fx.Slide
/*
 ---
 copyrights:
 - [MooTools](http://mootools.net)

 licenses:
 - [MIT License](http://mootools.net/license.txt)
 ...
 */
MooTools.More = {
	version : "1.4.0.1",
	build : "a4244edf2aa97ac8a196fc96082dd35af1abab87"
};
(function() {
	Fx.Scroll = new Class({
		Extends : Fx,
		options : {
			offset : {
				x : 0,
				y : 0
			},
			wheelStops : true
		},
		initialize : function(c, b) {
			this.element = this.subject = document.id(c);
			this.parent(b);
			if(typeOf(this.element) != "element") {
				this.element = document.id(this.element.getDocument().body);
			}
			if(this.options.wheelStops) {
				var d = this.element, e = this.cancel.pass(false, this);
				this.addEvent("start", function() {
					d.addEvent("mousewheel", e);
				}, true);
				this.addEvent("complete", function() {
					d.removeEvent("mousewheel", e);
				}, true);
			}
		},
		set : function() {
			var b = Array.flatten(arguments);
			if(Browser.firefox) {
				b = [Math.round(b[0]), Math.round(b[1])];
			}
			this.element.scrollTo(b[0], b[1]);
			return this;
		},
		compute : function(d, c, b) {
			return [0, 1].map(function(e) {
				return Fx.compute(d[e], c[e], b);
			});
		},
		start : function(c, d) {
			if(!this.check(c, d)) {
				return this;
			}
			var b = this.element.getScroll();
			return this.parent([b.x, b.y], [c, d]);
		},
		calculateScroll : function(g, f) {
			var d = this.element, b = d.getScrollSize(), h = d.getScroll(), j = d.getSize(), c = this.options.offset, i = {
				x : g,
				y : f
			};
			for(var e in i) {
				if(!i[e] && i[e] !== 0) {
					i[e] = h[e];
				}
				if(typeOf(i[e]) != "number") {
					i[e] = b[e] - j[e];
				}
				i[e] += c[e];
			}
			return [i.x, i.y];
		},
		toTop : function() {
			return this.start.apply(this, this.calculateScroll(false, 0));
		},
		toLeft : function() {
			return this.start.apply(this, this.calculateScroll(0, false));
		},
		toRight : function() {
			return this.start.apply(this, this.calculateScroll("right", false));
		},
		toBottom : function() {
			return this.start.apply(this, this.calculateScroll(false, "bottom"));
		},
		toElement : function(d, e) {
			e = e ? Array.from(e) : ["x", "y"];
			var c = a(this.element) ? {
				x : 0,
				y : 0
			} : this.element.getScroll();
			var b = Object.map(document.id(d).getPosition(this.element), function(g, f) {
				return e.contains(f) ? g + c[f] : false;
			});
			return this.start.apply(this, this.calculateScroll(b.x, b.y));
		},
		toElementEdge : function(d, g, e) {
			g = g ? Array.from(g) : ["x", "y"];
			d = document.id(d);
			var i = {}, f = d.getPosition(this.element), j = d.getSize(), h = this.element.getScroll(), b = this.element.getSize(), c = {
				x : f.x + j.x,
				y : f.y + j.y
			};
			["x", "y"].each(function(k) {
				if(g.contains(k)) {
					if(c[k] > h[k] + b[k]) {
						i[k] = c[k] - b[k];
					}
					if(f[k] < h[k]) {
						i[k] = f[k];
					}
				}
				if(i[k] == null) {
					i[k] = h[k];
				}
				if(e && e[k]) {
					i[k] = i[k] + e[k];
				}
			}, this);
			if(i.x != h.x || i.y != h.y) {
				this.start(i.x, i.y);
			}
			return this;
		},
		toElementCenter : function(e, f, h) {
			f = f ? Array.from(f) : ["x", "y"];
			e = document.id(e);
			var i = {}, c = e.getPosition(this.element), d = e.getSize(), b = this.element.getScroll(), g = this.element.getSize();
			["x", "y"].each(function(j) {
				if(f.contains(j)) {
					i[j] = c[j] - (g[j] - d[j]) / 2;
				}
				if(i[j] == null) {
					i[j] = b[j];
				}
				if(h && h[j]) {
					i[j] = i[j] + h[j];
				}
			}, this);
			if(i.x != b.x || i.y != b.y) {
				this.start(i.x, i.y);
			}
			return this;
		}
	});
	function a(b) {
		return (/^(?:body|html)$/i).test(b.tagName);
	}

})();
Fx.Slide = new Class({
	Extends : Fx,
	options : {
		mode : "vertical",
		wrapper : false,
		hideOverflow : true,
		resetHeight : false
	},
	initialize : function(b, a) {
		b = this.element = this.subject = document.id(b);
		this.parent(a);
		a = this.options;
		var d = b.retrieve("wrapper"), c = b.getStyles("margin", "position", "overflow");
		if(a.hideOverflow) {
			c = Object.append(c, {
				overflow : "hidden"
			});
		}
		if(a.wrapper) {
			d = document.id(a.wrapper).setStyles(c);
		}
		if(!d) {
			d = new Element("div", {
				styles : c
			}).wraps(b);
		}
		b.store("wrapper", d).setStyle("margin", 0);
		if(b.getStyle("overflow") == "visible") {
			b.setStyle("overflow", "hidden");
		}
		this.now = [];
		this.open = true;
		this.wrapper = d;
		this.addEvent("complete", function() {
			this.open = (d["offset" + this.layout.capitalize()] != 0);
			if(this.open && this.options.resetHeight) {
				d.setStyle("height", "");
			}
		}, true);
	},
	vertical : function() {
		this.margin = "margin-top";
		this.layout = "height";
		this.offset = this.element.offsetHeight;
	},
	horizontal : function() {
		this.margin = "margin-left";
		this.layout = "width";
		this.offset = this.element.offsetWidth;
	},
	set : function(a) {
		this.element.setStyle(this.margin, a[0]);
		this.wrapper.setStyle(this.layout, a[1]);
		return this;
	},
	compute : function(c, b, a) {
		return [0, 1].map(function(d) {
			return Fx.compute(c[d], b[d], a);
		});
	},
	start : function(b, e) {
		if(!this.check(b, e)) {
			return this;
		}
		this[e||this.options.mode]();
		var d = this.element.getStyle(this.margin).toInt(), c = this.wrapper.getStyle(this.layout).toInt(), a = [[d, c], [0, this.offset]], g = [[d, c], [-this.offset, 0]], f;
		switch(b) {
			case"in":
				f = a;
				break;
			case"out":
				f = g;
				break;
			case"toggle":
				f = (c == 0) ? a : g;
		}
		return this.parent(f[0], f[1]);
	},
	slideIn : function(a) {
		return this.start("in", a);
	},
	slideOut : function(a) {
		return this.start("out", a);
	},
	hide : function(a) {
		this[a||this.options.mode]();
		this.open = false;
		return this.set([-this.offset, 0]);
	},
	show : function(a) {
		this[a||this.options.mode]();
		this.open = true;
		return this.set([0, this.offset]);
	},
	toggle : function(a) {
		return this.start("toggle", a);
	}
});
Element.Properties.slide = {
	set : function(a) {
		this.get("slide").cancel().setOptions(a);
		return this;
	},
	get : function() {
		var a = this.retrieve("slide");
		if(!a) {
			a = new Fx.Slide(this, {
				link : "cancel"
			});
			this.store("slide", a);
		}
		return a;
	}
};
Element.implement({
	slide : function(d, e) {
		d = d || "toggle";
		var b = this.get("slide"), a;
		switch(d) {
			case"hide":
				b.hide(e);
				break;
			case"show":
				b.show(e);
				break;
			case"toggle":
				var c = this.retrieve("slide:flag", b.open);
				b[c?"slideOut":"slideIn"](e);
				this.store("slide:flag", !c);
				a = true;
				break;
			default:
				b.start(d, e);
		}
		if(!a) {
			this.eliminate("slide:flag");
		}
		return this;
	}
});

/**
 * PHOTOCAKE scripts start here
 */

/**
 * Initialize img-photo for fade in
 */
function initImage() {

	$('img-photo').setStyle('opacity', 0);
	if($('img-nav-links') != null) {
		$('img-nav-links').addClass('hidden');
	}

	$('img-photo').addEvent('load', function() {
		fadeImage();
	});
}

/**
 * Fade img-foto in and show img-nav-links
 */
function fadeImage() {

	var fadeFx = new Fx.Tween('img-photo', {
		property : 'opacity',
		duration : 500,
		transition : Fx.Transitions.Expo.easeInOut
	});

	fadeFx.start(0, 1).chain(function() {
		if($('img-nav-links') != null) {
			$('img-nav-links').removeClass('hidden');
		}
	});
	fadeImage = function() {
	};
}

/**
 * Initizialize navigation arrows
 */
function initNavigationArrows() {
	if($('img-nav-nextarrow') != null) {
		$('img-nav-nextarrow').addClass('hidden');
		$('img-map-next').addEvent('mouseover', function() {
			$('img-nav-nextarrow').removeClass('hidden');
		});
		$('img-nav-nextarrow').addEvent('mouseover', function() {
			$('img-nav-nextarrow').removeClass('hidden');
		});
		$('img-map-next').addEvent('mouseout', function() {
			$('img-nav-nextarrow').addClass('hidden');
		});
		$('img-nav-nextarrow').addEvent('mouseout', function() {
			$('img-nav-nextarrow').addClass('hidden');
		});
	}
	if($('img-nav-prevarrow') != null) {
		$('img-nav-prevarrow').addClass('hidden');
		$('img-map-prev').addEvent('mouseover', function() {
			$('img-nav-prevarrow').removeClass('hidden');
		});
		$('img-nav-prevarrow').addEvent('mouseover', function() {
			$('img-nav-prevarrow').removeClass('hidden');
		});
		$('img-map-prev').addEvent('mouseout', function() {
			$('img-nav-prevarrow').addClass('hidden');
		});
		$('img-nav-prevarrow').addEvent('mouseout', function() {
			$('img-nav-prevarrow').addClass('hidden');
		});
	}
}

/**
 * Initizialize transition of the comment area
 */
function initCommentArea() {

	var slideFx = new Fx.Slide('notes-cmts-container', {
		duration : 400,
		link : 'chain',
		transition : Fx.Transitions.Sine.easeInOut
	});
	var scrollFx = new Fx.Scroll(window, {
		duration : 400,
		link : 'chain',
		transition : Fx.Transitions.Expo.easeInOut
	});

	if((window.location.hash == '') || (window.location.hash == '#')) {
		if(Cookie.read('notes-cmts-container') != null) {
			if(Cookie.read('notes-cmts-container') != 'show') {
				slideFx.hide();
			}
		} else {
			slideFx.hide();
		}
	} else {
		Cookie.write('notes-cmts-container', 'show', {
			path : '/',
			duration : 9999
		});
	}

	$('info-toggle').addEvent('click', function(e) {
		if(e) {
			e.stop();
		}
		if(slideFx.open == false) {
			Cookie.write('notes-cmts-container', 'show', {
				path : '/',
				duration : 9999
			});
			slideFx.slideIn().chain(function() {
				scrollFx.toElement('notes-cmts-container');
				$('info-toggle').removeProperty('name');
				window.location.hash = '#comments';
			});
			$('CommentName').focus();
		} else {
			Cookie.write('notes-cmts-container', 'hide', {
				path : '/',
				duration : 9999
			});
			scrollFx.toTop().chain(function() {
				slideFx.slideOut();
				window.location.hash = '';
			});
		}
	});
}

/**
 * Initizialize thumbnail mouseover
 */
function initThumbnails() {
	$$('.thumbnails').each(function(thumbnail) {

		thumbnail.addEvent('mouseover', function() {
			thumbnail.setStyle('opacity', '0.6');
		});
		thumbnail.addEvent('mouseout', function() {
			thumbnail.setStyle('opacity', '1');
		});
	});
}

function isFormTag(tagName) {
	tagName = tagName.toUpperCase();
	if(tagName == "INPUT" || tagName == "TEXTAREA" || tagName == "SELECT" || tagName == "OPTION" || tagName == "BUTTON") {
		return true;
	}
	return false;
}

function initKeyNavigation() {
	document.addEvent('keydown', function(event) {
		if(!isFormTag(event.target.tagName)) {
			switch(event.code) {
				// right
				case 39:
					new Event(event).stop();
					if($('img-map-next') != null) {
						window.location = $('img-map-next').get('href');
					}
					break;
				// left
				case 37:
					new Event(event).stop();
					if($('img-map-prev') != null) {
						window.location = $('img-map-prev').get('href');
					}
					break;
				// c & k & e
				case 67:
				case 69:
				case 75:
					new Event(event).stop();
					if($('info-toggle') != null) {
						$('info-toggle').fireEvent('click');
					}
					break;
				// a & b
				case 65:
				case 66:
					new Event(event).stop();
					window.location = $('archive_link').get('href');
					break;
			}
		}
	});
}

/* Load Events */
window.addEvent('load', function() {
	if($('img-photo') != null) {
		fadeImage();
	}
});
/* Load Events END */

/* DomReady Events */
window.addEvent('domready', function() {
	if($('img-photo') != null) {
		initImage();
	}

	if($('info-toggle') != null) {
		initNavigationArrows();
		initKeyNavigation();
	}

	if($('notes-cmts-container') != null) {
		initCommentArea();
	}

	initThumbnails();
});
/* DomReady Events END*/