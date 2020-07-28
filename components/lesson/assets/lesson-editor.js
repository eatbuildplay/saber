(function($) {



	var LessonEditor = {

		init: function() {

			LessonEditor.initVideoField();
			LessonEditor.resourcesField.init();

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

		},

		resourcesField: {

			dataEl: $('#lesson_resources'),

			init: function() {

				// make field wrapper
				var wrapper = '<div id="resource_field_content"></div>';
				$wrapper = $( wrapper ).insertAfter( LessonEditor.resourcesField.dataEl );

				// make add button
				var addButton = '<button id="resource_add_button">+ Add</button>';
				$wrapper.append( addButton );

				// make list
				var itemHtml = $('#lesson_resources_item').html();
				var $list = $('<ul></ul>').appendTo( $wrapper );

				// make list sortable
				$list.sortable();

				// click handlers
				LessonEditor.resourcesField.addClick();
				LessonEditor.resourcesField.editClick();
				LessonEditor.resourcesField.deleteClick();
				LessonEditor.resourcesField.saveClick();

			},

			updateData: function() {

				var data = [];
				$('#resource_field_content > ul').find('li').each( function() {
					var obj = {

					}
					obj.label = $(this).find('.resources-label-field input').val();
					obj.url = $(this).find('.resources-url-field input').val();
					data.push( obj );
				});
				LessonEditor.resourcesField.dataEl.val( JSON.stringify(data) );

			},

			addClick: function() {

				$(document).on('click', '#resource_add_button', function(e) {

					e.preventDefault();

					var itemHtml = $('#lesson_resources_item').html();
					var list = $('#resource_field_content').find('ul');
					var item = $( itemHtml ).appendTo( list );
					item.find('.resources-display').hide();

					LessonEditor.resourcesField.updateData();

				});

			},

			editClick: function() {

				$(document).on('click', '.resource-edit-button', function() {

					var item = $(this).closest('li');
					item.find('.resources-edit').show();
					item.find('.resources-display').hide();

					LessonEditor.resourcesField.updateData();

				});

			},

			saveClick: function() {

				$(document).on('click', '.resource-save-button', function() {

					var item = $(this).closest('li');

					var label = item.find('.resources-label-field input').val();
					var url = item.find('.resources-url-field input').val();

					item.find('a').prop('href', url);
					item.find('a').text(label);

					item.find('.resources-edit').hide();
					item.find('.resources-display').show();

					LessonEditor.resourcesField.updateData();

				});

			},

			deleteClick: function() {

				$(document).on('click', '.resource-remove-button', function() {

					$(this).closest('li').remove();
					LessonEditor.resourcesField.updateData();

				});

			},

		}

	}

	LessonEditor.init();

})( jQuery );
