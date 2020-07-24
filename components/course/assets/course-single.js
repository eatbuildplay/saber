(function($) {

  var CourseSingle = {

    init: function() {

      $('.course-menu-section-list li').on('click', function() {

        var item = $(this);
        var id = item.data('id');

        CourseSingle.updateLesson( id );

      })

      // course menu controls
      $('.course-menu-collapse').on('click', function(e) {
        e.preventDefault();
        $('.course-menu-list').hide();
      });

      //course-menu-expand

    },

    updateLesson: function( id ) {

      var content = 'CONTENT!! ---- ';
      content += id;
      $('#lesson-canvas').html( content );

    }

  }

  CourseSingle.init();


})( jQuery );
