var CourseSingle = {

  player: false,

  init: function() {

    CourseSingle.initStudyGuide();

    /* menu click handlers */
    CourseSingle.menuSectionClickHandler();
    CourseSingle.menuClickHandler();
    CourseSingle.menuCollapseExpandClickHandler();

    // open by default
    jQuery('.course-menu-section-list').show();
    jQuery('.course-menu-section-header').addClass('open');
    jQuery('.course-menu-section-header').find('i').removeClass('fa-chevron-right');
    jQuery('.course-menu-section-header').find('i').addClass('fa-chevron-down');
    jQuery('.course-menu-section-list li').first().click();

    // init tabs
    CourseSingle.initLessonTabs();

  },

  menuClickHandler: function() {

    jQuery('.course-menu-section-list li').on('click', function() {

      var item = jQuery(this);
      var id = item.data('id');

      CourseSingle.updateLesson( id );

    });

  },

  menuSectionClickHandler: function() {

    jQuery('.course-menu-section-header').on('click', function() {
      if( jQuery(this).hasClass('open') ) {
        jQuery('.course-menu-section-list').hide();
        jQuery(this).removeClass('open');
        jQuery(this).find('i').removeClass('fa-chevron-down');
        jQuery(this).find('i').addClass('fa-chevron-right');
      } else {
        jQuery('.course-menu-section-list').show();
        jQuery(this).addClass('open');
        jQuery(this).find('i').removeClass('fa-chevron-right');
        jQuery(this).find('i').addClass('fa-chevron-down');
      }
    });

  },

  menuCollapseExpandClickHandler: function() {

    jQuery(document).on('click', '.course-menu-collapse', function(e) {
      e.preventDefault();
      jQuery(this).removeClass('course-menu-collapse').addClass('course-menu-expand');
      jQuery(this).find('i').removeClass('fa-angle-double-left').addClass('fa-angle-double-right');
      jQuery('.course-menu-list').hide();
    });

    jQuery(document).on('click', '.course-menu-expand', function(e) {
      e.preventDefault();
      jQuery(this).removeClass('course-menu-expand').addClass('course-menu-collapse');
      jQuery(this).find('i').removeClass('fa-angle-double-right').addClass('fa-angle-double-left');
      jQuery('.course-menu-list').show();
    });

  },

  initLessonTabs: function() {

    jQuery( document ).on('click', '#lesson-tabs header a', function(e) {
      e.preventDefault();
      jQuery( '#lesson-tabs li.lesson-tabs-tab' ).hide();
      jQuery( '#lesson-tabs header a' ).removeClass('active')
      jQuery(this).addClass('active');

      var target = jQuery(this).data('target');
      jQuery('#' + target).show();
    });


    jQuery( '#lesson-tabs header a' ).first().click();

  },

  updateLesson: function( id ) {

    // get timeline item by id
    var timelineItem = CourseSingle.getTimelineItem( id );

    if( timelineItem.type == 'lesson' ) {
      CourseSingle.lessonLoad( timelineItem );
    }

    if( timelineItem.type == 'exam' ) {

      var exam = timelineItem;

      var examCanvasHtml = jQuery('#exam-template').html();
      var $examCanvasEl = jQuery( examCanvasHtml );

      jQuery('.course-body-right').html('');
      $examCanvasEl.appendTo( '.course-body-right' );

      var startHtml = jQuery('#exam-single-start').html();
      var startEl = jQuery( startHtml );
      startEl.appendTo( $examCanvasEl );

      $examCanvasEl.attr('data-exam-id', exam.id );

      Exam.id = exam.id;
      Exam.init();

    }

  },

  lessonLoad: function( lesson ) {

    var lessonTemplate = jQuery('#lesson-template').html();
    var $lessonTemplate = jQuery( lessonTemplate );

    // lesson tabs
    var $lessonTabs = $lessonTemplate.find('#lesson-tabs');

    // parse lesson overview
    if( lesson.overview == '' ) {
      jQuery('.lesson-overview').hide();
    } else {
      lessonTabsHtml = $lessonTabs.html().replace( '{{lesson_overview}}', lesson.overview );
      $lessonTabs.html( lessonTabsHtml );
    }

    var firstTab = $lessonTabs.find('header a').first();
    var firstTabTarget = firstTab.data('target');
    firstTab.addClass('active');
    $lessonTemplate.find('#lesson-tabs').html( $lessonTabs.html() );

    jQuery('.course-body-right').html( $lessonTemplate );
    jQuery('#' + firstTabTarget).show();

    if( lesson.professor ) {

      jQuery('.lesson-author-name').text( lesson.professor.data.display_name );
      jQuery('.lesson-author-bio').html( lesson.professor.data.bio );
      jQuery('.lesson-author-profile').attr( 'src', lesson.professor.data.avatar );

    }

    console.log( lesson )

    // lesson resources
    if( lesson.resources.length >= 1 ) {
      var resources = JSON.parse( lesson.resources );
      var $lessonResources = jQuery('#lesson-resources');
      $lessonResources.append('<ul></ul>');
      resources.forEach( function( resource ) {
        var item = '<li>';
        item += '<a href="' + resource.url + '">';
        item += resource.label;
        item += '</a>';
        item += '</li>';
        $lessonResources.append(item);
      });
    }

    // setup video
    if( lesson.video ) {

      if( CourseSingle.player ) {
        CourseSingle.player.dispose();
      }

      CourseSingle.player = videojs('videoPlayer', {
        controls: 1,
        autoplay: 0,
        preload: 'auto',
        fluid: 1
      });

      CourseSingle.player.src({
        type: 'video/mp4',
        src: lesson.video.url
      });

    }

  },

  getTimelineItem: function( id ) {

    var matchedItem = false;
    saberCourse.course.timeline.forEach( function( item ) {
      if( item.id == id ) {
        matchedItem = item;
      }
    });

    return matchedItem;

  },

  initStudyGuide: function() {

    if( saberCourse.course.studyGuide ) {

      jQuery('.course-header-menu a').on('click', function(e) {
        e.preventDefault();

        if( jQuery(this).hasClass('course-study-guide-download') ) {
          window.open( saberCourse.course.studyGuide.url );
        }

      });

    } else {

      // no study guide
      jQuery('.course-study-guide-download').hide();

    }

  }

}

CourseSingle.init();
