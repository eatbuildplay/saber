(function($) {

  var ExamEditor = {

    data: {
      timeline: []
    }, // stores the exam data

    init: function() {

      /* init load */
      var dataJson = $('#exam-editor-data').val();
      // ExamEditor.data = JSON.parse( dataJson );

      /* menu handlers */
      ExamEditor.menuClear();
      ExamEditor.questionSetup();

      $('.exam-editor-menu button').on('click', function(e) {
        e.preventDefault();
      });

      /* question search handler */
      $('#question-search-button').on('click', function() {
        ExamEditor.searchQuestions();
      });

      /* Click on option returned from search */
      $(document).on('click', '.clickable-option', function() {

        var data = {};
        data.type = $(this).data('type');
        data.id = $(this).data('id');
        data.title = $(this).html();

        // check for duplicate in timeline
        var isDuplicate = ExamEditor.timelineDuplicateCheck( data );
        if( isDuplicate ) {
          return;
        }

        // move item (or clone item) into exam timeline
        ExamEditor.insertTimeline( data );

        // update the data
        var timelineItem = {
          type: data.type,
          id: data.id
        };
        ExamEditor.data.timeline.push( timelineItem );
        $('#exam-editor-data').val( JSON.stringify(ExamEditor.data));


      });

      /* setup sorting */
      $( '.exam-editor-timeline-grid' ).sortable({
        stop: function( event, ui ) {
          ExamEditor.sortingHandler();
        }
      });

      /* search clear */
      $(document).on('click', '.ce-search-clear', function(e) {
        e.preventDefault();
        $('#search-form-question .search-results').html('');
        $('#search-form-question .search-box').val('');
      });

      /* trash item */
      $(document).on('click', '.exam-editor-timeline-item .dashicons-trash', function() {
        $(this).parent().remove();
        ExamEditor.sortingHandler();
      });

    },

    emptySearchHandlerQuestions: function() {
      var msg = '<div class="exam-editor-empty-search">';
      msg +=    'No results found, please try a different search term.';
      msg +=    '</div>';
      $('#ceLessonSearchResults').append( msg );
    },

    /* Duplicate check */
    timelineDuplicateCheck: function( data ) {

      var isDuplicate = 0;

      ExamEditor.data.timeline.forEach( function( item ) {

        if( item.id == data.id ) {
          isDuplicate = 1;
        }

      });

      return isDuplicate;

    },

    menuClear: function() {



    },

    questionSetup: function() {

      $('#question-add-button').on('click', function() {

        ExamEditor.menuClear();
        $('#search-form-question').show();
        $(this).addClass('active');

      });

    },

    /* Insert item to timeline */
    insertTimeline: function( data ) {

      if( data.type == 'exam' ) {
        var timelineItem = '<div class="exam-editor-timeline-item exam-editor-timeline-item-exam" data-id="' + data.id + '" data-type="lesson">';
      } else {
        var timelineItem = '<div class="exam-editor-timeline-item" data-id="' + data.id + '" data-type="lesson">';
      }
      timelineItem += data.title;
      timelineItem += '<span class="dashicons dashicons-trash"></span>';
      timelineItem += '</div>';

      var timelineGrid = $('.exam-editor-timeline-grid');
      timelineGrid.append( timelineItem );

    },

    sortingHandler: function() {

      // clear existing timeline data
      ExamEditor.data.timeline = [];


      $('.exam-editor-timeline-item').each( function( index, item ) {

        var itemEl = $(item);

        console.log(itemEl)

        // update the data
        var timelineItem = {
          type: itemEl.data('type'),
          id: itemEl.data('id')
        };
        ExamEditor.data.timeline.push( timelineItem );

      });

      $('#ceEditorData').val( JSON.stringify(ExamEditor.data));

    },

    searchQuestions: function() {

      data = {
        action: 'saber_exam_editor_question_search',
        search: $('#lesson-search-box').val(),
      }
      $.post(
        ajaxurl,
        data,
        function( response ) {

          console.log( response );
          var searchResultsEl = $('#search-form-question .search-results');

          searchResultsEl.html('');
          response = JSON.parse(response);

          if( response.items.length == 0 ) {
            ExamEditor.emptySearchHandlerQuestions();
            return;
          }

          response.items.forEach( function( item ) {

            console.log( item )

            var clickableOption = '<div class="clickable-option" data-id="' + item.id + '" data-type="question">';
            clickableOption += '<h4>' + item.title + '</h4>';
            clickableOption += '</div>';

            searchResultsEl.append( clickableOption );

          });

          var clearButton = '<button class="ce-search-clear">';
          clearButton += 'Clear';
          clearButton += '</button>';
          $('#ceLessonSearchResults').append( clearButton );

        }
      );

    },

  } // end ExamEditor


  // init
  ExamEditor.init();

})( jQuery );
