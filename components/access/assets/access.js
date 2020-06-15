(function($) {

  /* Access Class */
  var access = {

    grant: false,
    student: false,
    course: false,

    init: function() {

      access.grant    = saberCourseAccess.access.grant;
      access.student  = saberCourseAccess.access.student;
      access.course   = saberCourseAccess.access.course;

      if( !access.grant ) {
        access.block();
      }

    },

    block: function() {

      console.log('blocking...');

      // block click
      $(document).on('click.block', '.course-lesson-list-item-wrap a', function(e) {
        e.preventDefault();
        console.log('blocking!!!!');
      })

    }

  }

  // init
  access.init();

})( jQuery );
