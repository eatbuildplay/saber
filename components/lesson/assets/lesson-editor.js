(function($) {



	var LessonEditor = {

		init: function() {

			LessonEditor.initVideoField();

		},

		initVideoField: function() {

			var inputEl = $('#lesson_video');

			// initial load state handling
			if( inputEl.val() == '' ) {
				inputEl.after('<button class="saber-uploader">Add Video</button>');
			} else {
				inputEl.after('<button class="saber-uploader-remove">Remove Video</button>');
				inputEl.after('<button class="saber-uploader">Change Video</button>');
				inputEl.after('<span class="saber-uploader-title">' + inputEl.data('filename')  + '</span>');
			}

			// add video click
			$(document).on( 'click', '.saber-uploader', function(e) {

				e.preventDefault();

				var button = $(this);

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

					console.log( attachment );

					$('.saber-uploader-title').text( attachment.filename ).show();
					button.text('Change Video');
					$('.saber-uploader-remove').show();

		      inputEl.val( attachment.id );

				}).open();

			});

			// on remove button click
			$(document).on('click', '.saber-uploader-remove', function(e){

				e.preventDefault();

				var button = $(this);
		    button.hide();
				inputEl.val(''); // emptying the hidden field
				$('.saber-uploader-title').hide();
				$('.saber-uploader').text('Add Video');

			});

		}

	}

	LessonEditor.init();

})( jQuery );
