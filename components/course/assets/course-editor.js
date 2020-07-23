(function($) {

  var courseEditor = {

    data: {
      timeline: []
    }, // stores the course data

    init: function() {

      /* init load */
      var dataJson = $('#ceEditorData').val();
      courseEditor.data = JSON.parse( dataJson );

      /* menu handlers */
      courseEditor.menuClear();
      courseEditor.lessonSetup();
      courseEditor.examSetup();

      /*
      courseEditor.data.timeline.forEach( function( data ) {
        courseEditor.insertTimeline( data );
      });
        // replaced by PHP output
      */

      $('.course-editor-menu button').on('click', function(e) {
        e.preventDefault();
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

            if( response.lessons.length == 0 ) {
              courseEditor.emptySearchHandler();
              return;
            }

            response.lessons.forEach( function( lesson ) {

              console.log( lesson )

              var clickableOption = '<div class="clickable-option" data-id="' + lesson.id + '">';
              clickableOption += '<h4>' + lesson.title + '</h4>';
              clickableOption += '</div>';

              $('#ceLessonSearchResults').append( clickableOption );

            });

            var clearButton = '<button class="ce-search-clear">';
            clearButton += 'Clear';
            clearButton += '</button>';
            $('#ceLessonSearchResults').append( clearButton );

          }
        );

      });

      /* Click on option returned from search */
      $(document).on('click', '.clickable-option', function() {

        var data = {};
        data.type = 'lesson';
        data.id = $(this).data('id');
        data.title = $(this).html();

        // check for duplicate in timeline
        var isDuplicate = courseEditor.timelineDuplicateCheck( data );
        if( isDuplicate ) {
          console.log('is dup');
          return;
        }

        // move item (or clone item) into course timeline
        courseEditor.insertTimeline( data );

        // update the data
        var timelineItem = {
          type: 'lesson',
          id: data.id
        };
        courseEditor.data.timeline.push( timelineItem );
        $('#ceEditorData').val( JSON.stringify(courseEditor.data));


      });

      /* setup sorting */
      $( '.course-editor-timeline-grid' ).sortable({
        stop: function( event, ui ) {
          courseEditor.sortingHandler();
        }
      });

      /* search clear */
      $(document).on('click', '.ce-search-clear', function(e) {
        e.preventDefault();
        $('#ceLessonSearchResults').html('');
        $('#lessonSearchBox').val('');
      });

      /* trash item */
      $(document).on('click', '.course-editor-timeline-item .dashicons-trash', function() {
        console.log('trashican...')

        $(this).parent().remove();
        courseEditor.sortingHandler();

      });

    },

    emptySearchHandler: function() {
      var msg = '<div class="course-editor-empty-search">';
      msg +=    'No results found, please try a different search term.';
      msg +=    '</div>';
      $('#ceLessonSearchResults').append( msg );
    },

    /* Duplicate check */
    timelineDuplicateCheck: function( data ) {

      var isDuplicate = 0;

      courseEditor.data.timeline.forEach( function( item ) {

        if( item.id == data.id ) {
          isDuplicate = 1;
        }

      });

      return isDuplicate;

    },

    menuClear: function() {

      $('.course-editor-lesson-search').hide();
      $('#ceLessonAddButton').removeClass('active');

      $('.course-editor-exam-search').hide();
      $('#ceExamAddButton').removeClass('active');

    },

    examSetup: function() {

      $('#ceExamAddButton').on('click', function() {

        courseEditor.menuClear();
        $('.course-editor-exam-search').show();
        $(this).addClass('active');

      });

    },

    lessonSetup: function() {

      $('#ceLessonAddButton').on('click', function() {

        courseEditor.menuClear();
        $('.course-editor-lesson-search').show();
        $(this).addClass('active');

      });

    },

    /* Insert item to timeline */
    insertTimeline: function( data ) {

      var timelineItem = '<div class="course-editor-timeline-item" data-id="' + data.id + '" data-type="lesson">';
      timelineItem += data.title;
      timelineItem += '<span class="dashicons dashicons-trash"></span>';
      timelineItem += '</div>';

      var timelineGrid = $('.course-editor-timeline-grid');
      timelineGrid.append( timelineItem );

    },

    sortingHandler: function() {

      // clear existing timeline data
      courseEditor.data.timeline = [];


      $('.course-editor-timeline-item').each( function( index, item ) {

        var itemEl = $(item);

        console.log(itemEl)

        // update the data
        var timelineItem = {
          type: itemEl.data('type'),
          id: itemEl.data('id')
        };
        courseEditor.data.timeline.push( timelineItem );

      });

      $('#ceEditorData').val( JSON.stringify(courseEditor.data));

    }

  } // end courseEditor


  // init
  courseEditor.init();

})( jQuery );
