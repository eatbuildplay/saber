(function($) {

  /*
   * Register class
   */
  var register = {

    init: function() {

      $('#saber-register-form').submit( function(e) {

        e.preventDefault();

        var emailEl = $('.register-email');
        var emailValid = register.validateEmail( emailEl );

        var usernameEl = $('.register-username');

        if( !emailValid ) {
          register.showValidationError();
          return;
        }

        var fieldData = {
          email: emailEl.val(),
          username: usernameEl.val()
        }
        register.process( fieldData );

      });

    },

    showValidationError: function() {
      console.log( 'validation error handler...' );
    },

    process: function( fieldData ) {

      data = {
        action: 'saber_register',
        fieldData: fieldData
      }
      $.post( saber_post_list_load.ajaxurl, data, function( response ) {

        response = JSON.parse( response );

        console.log(response)

        if ( response.status == 'success' ) {

        } else {

        }

      });

    },

    validateEmail: function( el ) {
      let email = el.val()
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    }

  }
  register.init();

})( jQuery );
