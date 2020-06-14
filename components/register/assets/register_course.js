(function($) {

  /* Access Class */
  var registerCourse = {

    init: function() {

      $(document).on('click', '.course-register-button', function() {
        let courseId = $(this).data('course-id');
        registerCourse.doRegistration( courseId );
      })

    },

    doRegistration: function( courseId ) {
      data = {
        action: 'saber_course_register',
        courseId: courseId
      }
      $.post( saber_post_list_load.ajaxurl, data, function( response ) {

        response = JSON.parse(response);

        if( response.result > 0 ) {
          $('.course-register-button').replaceWith('Course registration complete, you are now enrolled.');
          registerCourse.registered = 1;
        }

      });
    }

  }

  // init
  registerCourse.init();

})( jQuery );
