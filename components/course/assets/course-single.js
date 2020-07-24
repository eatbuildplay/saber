(function($) {

  var CourseSingle = {

    player: videojs('videoPlayer', {
      controls: 1,
      autoplay: 0,
      preload: 'auto',
      fluid: 1
    }),

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

      console.log( saberCourse );

      var videoUrl = saberCourse.course.timeline[0].video.url;

      console.log( videoUrl );

      CourseSingle.player.src({
        type: 'video/mp4',
        src: videoUrl
      });

      //var content = 'CONTENT!! ---- ';
      //content += id;
      //$('#lesson-canvas').html( content );

    }

  }

  CourseSingle.init();


})( jQuery );
