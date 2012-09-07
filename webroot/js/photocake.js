function initImage() {
	$('img-photo').setStyle('opacity', 0);
	if($('img-nav-links') != null) {
		$('img-nav-links').addClass('hidden');
	}

	var fadeFx = new Fx.Tween('img-photo', {
		property : 'opacity',
		duration : 500,
		transition : Fx.Transitions.Expo.easeInOut
	});

	$('img-photo').addEvent('load', function() {
		fadeFx.start(0, 1).chain(function() {
			if($('img-nav-links') != null) {
				$('img-nav-links').removeClass('hidden');
			}
		});
	})
}

function initNavigationArrows() {
	if($('img-nav-nextarrow') != null) {
		$('img-nav-nextarrow').addClass('hidden');
		$('img-map-next').addEvent('mouseover', function() {
			$('img-nav-nextarrow').removeClass('hidden');
		});
		$('img-map-next').addEvent('mouseout', function() {
			$('img-nav-nextarrow').addClass('hidden');
		});
	}
	if($('img-nav-prevarrow') != null) {
		$('img-nav-prevarrow').addClass('hidden');
		$('img-map-prev').addEvent('mouseover', function() {
			$('img-nav-prevarrow').removeClass('hidden');
		});
		$('img-map-prev').addEvent('mouseout', function() {
			$('img-nav-prevarrow').addClass('hidden');
		});
	}
}

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

	if(Cookie.read('notes-cmts-container') != null) {
		if(Cookie.read('notes-cmts-container') != 'show') {
			slideFx.hide();
		}
	}

	$('info-toggle').addEvent('click', function() {
		if(slideFx.open == false) {
			Cookie.write('notes-cmts-container', 'show', {
				path : '/',
				duration : 9999
			});
			slideFx.slideIn().chain(function() {
				scrollFx.toElement('notes-cmts-container');
			});
			$('CommentName').focus();
		} else {
			Cookie.write('notes-cmts-container', 'hide', {
				path : '/',
				duration : 9999
			});
			scrollFx.toTop().chain(function() {
				slideFx.slideOut();
			});
		}
	});
}

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

window.addEvent('domready', function() {
	if($('img-photo') != null) {
		initImage();
	}

	if($('info-toggle') != null) {
		initNavigationArrows();
	}

	if($('notes-cmts-container') != null) {
		initCommentArea();
	}

	initThumbnails();
});
