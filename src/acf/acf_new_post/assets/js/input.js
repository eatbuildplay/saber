(function($) {

	function initialize_field() {

		/*
		 * Open dialog button
		 */
		var $button = $('.acf-new-post-field button');
		console.log($button)
		$button.on('click', function(e) {

			console.log("PREVENT#!!!!!")

			e.preventDefault();
	    $('#create-phrase-dialog').dialog('open');

		});

		/*
		 * Dialog init
		 */
		 // initalise the dialog
	   $('#create-phrase-dialog').dialog({
	     title: 'Create Phrase',
	     dialogClass: 'wp-dialog',
	     autoOpen: false,
	     draggable: false,
	     width: '800',
	     modal: true,
	     resizable: false,
	     closeOnEscape: true,
	     position: {
	       my: "center",
	       at: "center",
	       of: window
	     },
	     open: function () {

	 			// form setup
	 			var form = $('template#new-post-form');
	 			var formWrapper = $('.form-wrapper');
	 			$('.form-wrapper').html( form.html() );

	       $('.ui-widget-overlay').on('click', function() {
	 				$('#create-phrase-dialog').dialog('close');
	       })
	     },
	     create: function () {
	       // style fix for WordPress admin
	       $('.ui-dialog-titlebar-close').addClass('ui-button');
	     },
	   });

		/*
		 * Submit form handler
		 */
		$(document).on('submit', '#saber-form', function(e) {

			e.preventDefault();
			let $form = $('#saber-form');

			data = {
		    action: 'saber_new_post_form',
				formData: $form.serialize()
		  }
		  $.post( ajaxurl, data, function( response ) {

		     response = JSON.parse(response);
		     console.log( response )

		  });

		});

	}

	acf.addAction('ready', function(){
    initialize_field();
});


})(jQuery);
