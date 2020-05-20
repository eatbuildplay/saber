

<form id="frame-register-form" class="frame-form" method="POST">

  <input class="register-name" type="hidden" />

  <div class="frame-form-group">
    <label>Email</label>
    <input class="form-control register-email" name="register-email" type="text" />
  </div>

  <div class="frame-form-group">
    <label>Username</label>
    <input class="form-control register-username" name="register-username" type="text" />
  </div>

  <button>Register</button>

</form>


<style>

.frame-form {
  margin: 1rem 0;
}
.frame-form-group {
  margin-bottom: 1rem;
}

.frame-form-group label {
  display: inline-block;
  margin-bottom: .5rem;
}

.frame-form-group .form-control {
  display: block;
  width: 100%;
  max-width: 450px;
  padding: .375rem .75rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid #ced4da;
  border-radius: .25rem;
  transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.frame-form button {
  color: #fff;
  background-color: #1A7283;
  border-color: #1A7283;
  width: 100%;
  max-width: 450px;
  margin: 0.5rem 0;
}
.frame-form button:hover {
  background-color: #1A7283E6;
}

</style>


<script>



/*
 * jQuery
 */
(function($) {

  /*
   * Register class
   */
  var register = {

    init: function() {

      $('#frame-register-form').submit( function(e) {

        e.preventDefault();

        var emailEl = $('.register-email');
        var emailValid = register.validateEmail( emailEl );

        var usernameEl = $('.register-username');

        var fieldData = {
          email: emailEl.val(),
          username: usernameEl.val()
        }
        register.process( fieldData );

      });

    },

    process: function( fieldData ) {

      data = {
        action: 'frame_register',
        fieldData: fieldData
      }
      $.post( frame_post_list_load.ajaxurl, data, function( response ) {

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

</script>
