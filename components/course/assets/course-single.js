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

        if( $(this).hasClass('course-study-guide-download') ) {
          window.open('https://eatbuildplay.com/wp-content/uploads/2020/07/Saber-LMS-Docs.pdf');
        }

      });

      /* section header */
      $('.course-menu-section-header').on('click', function() {
        if( $(this).hasClass('open') ) {
          $('.course-menu-section-list').hide();
          $(this).removeClass('open');
          $(this).find('i').removeClass('fa-chevron-down');
          $(this).find('i').addClass('fa-chevron-right');
        } else {
          $('.course-menu-section-list').show();
          $(this).addClass('open');
          $(this).find('i').removeClass('fa-chevron-right');
          $(this).find('i').addClass('fa-chevron-down');
        }
      });

      // open by default
      $('.course-menu-section-list').show();
      $('.course-menu-section-header').addClass('open');
      $('.course-menu-section-header').find('i').removeClass('fa-chevron-right');
      $('.course-menu-section-header').find('i').addClass('fa-chevron-down');

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


      $( '#lesson-tabs header a' ).first().click();

    },

    updateLesson: function( id ) {

      console.log(id);
      console.log(saberCourse.course.timeline);

      var timelineItem = CourseSingle.getTimelineItem( id );

      console.log(timelineItem);

      var lesson = saberCourse.course.timeline[0];
      var overview = lesson.overview;

      // do replacement
      var lessonTabsHtml = $('#lesson-tabs').html();
      var updatedHtml = lessonTabsHtml.replace( '{{lesson_overview}}', lesson.overview);
      $('#lesson-tabs').html( updatedHtml );

      /*
      var videoUrl = saberCourse.course.timeline[0].video.url;
      CourseSingle.player.src({
        type: 'video/mp4',
        src: videoUrl
      });
      */

    },

    getTimelineItem: function( id ) {
      var matchedItem = false;
      saberCourse.course.timeline.forEach( function( item ) {
        if( item.id == id ) {
          matchedItem = item;
        }
      });
      return matchedItem;
    }

  }

  CourseSingle.init();


})( jQuery );
