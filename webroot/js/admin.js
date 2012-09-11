var parse_url;

function trim(s) {
	return s.replace(/^\s+/, '').replace(/\s+$/, '');
}

function parse() {
	if($$('.filename').length > 0) {
		var element = $$('.filename')[0];
		var filename = trim(element.get('value'));
		var id = element.get('id').replace('filename-', '');
		$('loading-' + id).removeClass('hidden');
		new Request.HTML({
			url : parse_url + filename,
			method : 'post',
			update : 'info-' + id,
			onComplete : function() {
				$('loading-' + id).addClass('hidden');
				$('infocontainer-' + id).removeClass('hidden');
				element.removeClass('filename');
				parse();
			}
		}).send();
	}
}

/* DomReady Events */
window.addEvent('domready', function() {
	parse_url = $('parse_url').get('value');
	parse();
});
