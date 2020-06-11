(function($) {

  /* Access Class */
  var registerCourse = {

    registered: false,
    student: false,
    course: false,

    init: function() {

      registerCourse.registered    = saberCourseRegistry.data.registered;
      registerCourse.student       = saberCourseRegistry.data.student;
      registerCourse.course        = saberCourseRegistry.data.course;

      console.log('REGISTRATION:');
      console.log( registerCourse );

      if( !registerCourse.registered ) {
        registerCourse.block();
      }

      $(document).on('click', '.course-register-button', function() {
        registerCourse.doRegistration();
      })

    },

    doRegistration: function() {
      data = {
        action: 'saber_course_register',
        courseId: registerCourse.course.id
      }
      $.post( saber_post_list_load.ajaxurl, data, function( response ) {

        response = JSON.parse(response);
        console.log( response );

        if( response.result > 0 ) {
          $('.course-register-button').replaceWith('Course registration complete, you are now enrolled.');
          registerCourse.registered = 1;
        }

      });
    },

    block: function() {

      // this needs to be fired as event call after post list loads
      var $lessonItems = $('.course-lesson-list-item-wrap');
      console.log($lessonItems);
      $lessonItems.addClass('register-course-blocked');

      // block click
      $(document).on('click', '.course-lesson-list-item-wrap.register-course-blocked a', function(e) {
        e.preventDefault();
      })

    }

  }

  // init
  registerCourse.init();

})( jQuery );
