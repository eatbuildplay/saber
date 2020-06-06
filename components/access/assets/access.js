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

      console.log('ACCESS:');
      console.log( access );

      if( !access.grant ) {
        access.block();
      }

    },

    block: function() {

      // this needs to be fired as event call after post list loads
      var $lessonItems = $('.saber-post-list-item-wrap');
      console.log($lessonItems);
      $lessonItems.addClass('access-blocked');

      // block click
      $(document).on('click', '.saber-post-list-item-wrap a', function(e) {
        e.preventDefault();
      })

    }

  }

  // init
  access.init();

})( jQuery );
