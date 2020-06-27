(function($){


	/**
	*  initialize_field
	*
	*  This function will initialize the $field.
	*
	*  @date	30/11/17
	*  @since	5.6.5
	*
	*  @param	n/a
	*  @return	n/a
	*/

	function initialize_field( $field ) {

		var $field = $('.acf-new-post-field');
		var $button = $('.acf-new-post-field button');

		// initalise the dialog
	  $('#my-dialog').dialog({
	    title: 'My Dialog',
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
	      // close dialog by clicking the overlay behind it
	      $('.ui-widget-overlay').bind('click', function(){
	        $('#my-dialog').dialog('close');
	      })
	    },
	    create: function () {
	      // style fix for WordPress admin
	      $('.ui-dialog-titlebar-close').addClass('ui-button');
	    },
	  });

		$button.on('click', function() {

	    $('#my-dialog').dialog('open');

		});

	}

	if( typeof acf.add_action !== 'undefined' ) {

		/*
		*  ready & append (ACF5)
		*
		*  These two events are called when a field element is ready for initizliation.
		*  - ready: on page load similar to $(document).ready()
		*  - append: on new DOM elements appended via repeater field or other AJAX calls
		*
		*  @param	n/a
		*  @return	n/a
		*/

		acf.add_action('ready_field/type=new_post', initialize_field);
		acf.add_action('append_field/type=new_post', initialize_field);


	}

})(jQuery);
