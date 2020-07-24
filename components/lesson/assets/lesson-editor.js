(function($) {

	var LessonEditor = {

	}

	$(document).on( 'click', '.saber-uploader', function(e) {

		e.preventDefault();

		var button = $(this);
    var lessonVideoInput = $('#lessonVideo');

		// see https://core.trac.wordpress.org/browser/tags/5.4.2/src/js/_enqueues/wp/media/models.js#L0
		var uploader = wp.media({
			title: 'Add Video',
			library : {
				// uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
				// type : 'image'
			},
			button: {
				text: '+ Add Video' // button label text
			},
			multiple: false
		}).on('select', function() { // it also has "open" and "close" events
			var attachment = uploader.state().get('selection').first().toJSON();
			button.html('<img src="' + attachment.url + '">');
      lessonVideoInput.val( attachment.id );
		}).open();

	});

	// on remove button click
	$('body').on('click', '.saber-uploader-remove', function(e){

		e.preventDefault();

		var button = $(this);
    button.hide();
		lessonVideoInput.val(''); // emptying the hidden field

	});

})( jQuery );
