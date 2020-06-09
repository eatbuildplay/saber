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

      });
    },

    block: function() {

      // this needs to be fired as event call after post list loads
      var $lessonItems = $('.saber-post-list-item-wrap');
      console.log($lessonItems);
      $lessonItems.addClass('registerCourse-blocked');

      // block click
      $(document).on('click', '.saber-post-list-item-wrap a', function(e) {
        e.preventDefault();
      })

    }

  }

  // init
  registerCourse.init();

})( jQuery );
