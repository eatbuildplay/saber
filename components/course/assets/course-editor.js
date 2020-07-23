(function($) {

  var courseEditor = {

    data: {
      timeline: []
    }, // stores the course data

    init: function() {

      $('.course-editor-menu button').on('click', function(e) {
        e.preventDefault();
      });

      $('#ceLessonAddButton').on('click', function() {

        $('.course-editor-lesson-search').show();
        $(this).addClass('active');

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

            $('#ceLessonSearchResults').html('');

            response = JSON.parse(response);
            console.log( response );

            response.lessons.forEach( function( lesson ) {

              console.log( lesson )

              var clickableOption = '<div class="clickable-option" data-id="' + lesson.id + '">';
              clickableOption += '<h4>' + lesson.title + '</h4>';
              clickableOption += '</div>';

              $('#ceLessonSearchResults').append( clickableOption );

            });

          }
        );

      });

      /* Click on option returned from search */
      $(document).on('click', '.clickable-option', function() {

        var data = {};
        data.id = $(this).data('id');
        data.title = $(this).html();

        // move item (or clone item) into course timeline
        courseEditor.insertTimeline( data );

        // update the data
        courseEditor.data.timeline.push( data.id );
        $('#ceEditorData').val( JSON.stringify(courseEditor.data));


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
