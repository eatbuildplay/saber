(function($) {

  var courseEditor = {

    init: function() {

      $('button').on('click', function(e) {
        e.preventDefault();
      });

      $('#ceLessonAddButton').on('click', function() {

        $('.course-editor-lesson-search').show();

      });

      /* Run lesson search */
      $('#ceLessonSearchButton').on('click', function() {

        console.log('run lesson search...')

        // post to lesson search function
        data = {
          action: 'saber_course_editor_lesson_search',
          search: $('#lessonSearchBox').val(),
        }
        $.post(
          ajaxurl,
          data,
          function( response ) {

            response = JSON.parse(response);
            console.log( response );

            response.lessons.forEach( function( lesson ) {

              console.log( lesson )

              var clickableOption = '<div class="clickable-option" data-id="' + lesson.id + '">';
              clickableOption += lesson.title;
              clickableOption += '</div>';

              $('.course-editor-lesson-search').append( clickableOption );

            });

          }
        );

      });

      /* Click on option returned from search */
      $(document).on('click', '.clickable-option', function() {

        var data = {};
        data.id = $(this).data('id');
        data.title = $(this).text();

        // move item (or clone item) into course timeline

        courseEditor.insertTimeline( data );

      });

      /* setup sorting */
      $( '.course-editor-timeline-grid' ).sortable();


    },

    /* Insert item to timeline */
    insertTimeline: function( data ) {

      var timelineItem = '<div class="course-editor-timeline-item">';
      timelineItem += data.title;
      timelineItem += '</div>';

      var timelineGrid = $('.course-editor-timeline-grid');
      timelineGrid.append( timelineItem );

    }

  } // end courseEditor


  // init
  courseEditor.init();

})( jQuery );
