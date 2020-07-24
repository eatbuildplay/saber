(function($) {

  var CourseSingle = {

    init: function() {

      $('.course-menu-section-list li').on('click', function() {
        console.log('CLICK LESSON...');
      })

      // course menu controls
      $('.course-menu-collapse').on('click', function(e) {
        e.preventDefault();
        $('.course-menu-list').hide();
      });

      //course-menu-expand

    }

  }

  CourseSingle.init();


})( jQuery );
