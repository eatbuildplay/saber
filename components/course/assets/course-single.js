(function($) {

  var CourseSingle = {

    player: videojs('videoPlayer', {
      controls: 1,
      autoplay: 0,
      preload: 'auto',
      fluid: 1
    }),

    init: function() {

      /* header menu items */
      $('.course-header-menu a').on('click', function(e) {
        e.preventDefault();
      });

      /* section header */
      $('.course-menu-section-header').on('click', function() {
        $('.course-menu-section-list').toggle();
      });

      $('.course-menu-section-list li').on('click', function() {

        var item = $(this);
        var id = item.data('id');

        CourseSingle.updateLesson( id );

      })

      // course menu controls
      $(document).on('click', '.course-menu-collapse', function(e) {
        e.preventDefault();
        $(this).removeClass('course-menu-collapse').addClass('course-menu-expand');
        $(this).find('i').removeClass('fa-angle-double-left').addClass('fa-angle-double-right');
        $('.course-menu-list').hide();
      });

      $(document).on('click', '.course-menu-expand', function(e) {
        e.preventDefault();
        $(this).removeClass('course-menu-expand').addClass('course-menu-collapse');
        $(this).find('i').removeClass('fa-angle-double-right').addClass('fa-angle-double-left');
        $('.course-menu-list').show();
      });

      //course-menu-expand


      // init tabs
      CourseSingle.initTabs();

    },

    initTabs: function() {

      $( '#lesson-tabs header a' ).on('click', function(e) {
        e.preventDefault();
        $( '#lesson-tabs li.lesson-tabs-tab' ).hide();
        $( '#lesson-tabs header a' ).removeClass('active')
        $(this).addClass('active');

        var target = $(this).data('target');
        $('#' + target).show();
      });

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
