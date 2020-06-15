(function($) {

  /* Access Class */
  var registerCourse = {

    init: function() {

      $(document).on('click', '.course-register-button', function() {

        // get course id
        let courseId = $(this).data('course-id');

        // show loader
        let loader = '<div class="lds-heart"><div></div></div>';
        $('.course-register-button').replaceWith( loader );

        // call main reg method
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
          $('.saber-access-block').html('Course registration complete, you are now enrolled.');
          $( document ).off('click.block', '.course-lesson-list-item-wrap a');
        }

      });
    }

  }

  // init
  registerCourse.init();

})( jQuery );
