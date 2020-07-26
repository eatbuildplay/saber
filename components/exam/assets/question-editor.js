(function($) {

  var QuestionEditor = {

    data: {
      timeline: []
    }, // stores the question data

    init: function() {

      /* init load */
      var dataJson = $('#question-editor-data').val();
      // QuestionEditor.data = JSON.parse( dataJson );

      /* menu handlers */
      QuestionEditor.menuClear();
      QuestionEditor.questionSetup();

      $('.question-editor-menu button').on('click', function(e) {
        e.preventDefault();
      });

      /* question search handler */
      $('#question-search-button').on('click', function() {
        QuestionEditor.searchQuestions();
      });

      /* Click on option returned from search */
      $(document).on('click', '.clickable-option', function() {

        var data = {};
        data.type = $(this).data('type');
        data.id = $(this).data('id');
        data.title = $(this).html();

        // check for duplicate in timeline
        var isDuplicate = QuestionEditor.timelineDuplicateCheck( data );
        if( isDuplicate ) {
          return;
        }

        // move item (or clone item) into question timeline
        QuestionEditor.insertTimeline( data );

        // update the data
        var timelineItem = {
          type: data.type,
          id: data.id
        };
        QuestionEditor.data.timeline.push( timelineItem );
        $('#question-editor-data').val( JSON.stringify(QuestionEditor.data.timeline));

      });

      /* setup sorting */
      $( '.question-editor-timeline-grid' ).sortable({
        stop: function( event, ui ) {
          QuestionEditor.sortingHandler();
        }
      });

      /* search clear */
      $(document).on('click', '.ce-search-clear', function(e) {
        e.preventDefault();
        $('#search-form-question .search-results').html('');
        $('#search-form-question .search-box').val('');
      });

      /* trash item */
      $(document).on('click', '.question-editor-timeline-item .dashicons-trash', function() {
        $(this).parent().remove();
        QuestionEditor.sortingHandler();
      });

    },

    emptySearchHandlerQuestions: function() {
      var msg = '<div class="question-editor-empty-search">';
      msg +=    'No results found, please try a different search term.';
      msg +=    '</div>';
      $('#ceLessonSearchResults').append( msg );
    },

    /* Duplicate check */
    timelineDuplicateCheck: function( data ) {

      var isDuplicate = 0;

      QuestionEditor.data.timeline.forEach( function( item ) {

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

        QuestionEditor.menuClear();
        $('#search-form-question').show();
        $(this).addClass('active');

      });

    },

    /* Insert item to timeline */
    insertTimeline: function( data ) {

      if( data.type == 'question' ) {
        var timelineItem = '<div class="question-editor-timeline-item question-editor-timeline-item-question" data-id="' + data.id + '" data-type="lesson">';
      } else {
        var timelineItem = '<div class="question-editor-timeline-item" data-id="' + data.id + '" data-type="lesson">';
      }
      timelineItem += data.title;
      timelineItem += '<span class="dashicons dashicons-trash"></span>';
      timelineItem += '</div>';

      var timelineGrid = $('.question-editor-timeline-grid');
      timelineGrid.append( timelineItem );

    },

    sortingHandler: function() {

      // clear existing timeline data
      QuestionEditor.data.timeline = [];

      $('.question-editor-timeline-item').each( function( index, item ) {

        var itemEl = $(item);

        // update the data
        var timelineItem = {
          type: itemEl.data('type'),
          id: itemEl.data('id')
        };
        QuestionEditor.data.timeline.push( timelineItem );

      });

      $('#question-editor-data').val( JSON.stringify(QuestionEditor.data.timeline));

    },

    searchQuestions: function() {

      data = {
        action: 'saber_question_editor_question_search',
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
            QuestionEditor.emptySearchHandlerQuestions();
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

  } // end QuestionEditor


  // init
  QuestionEditor.init();

})( jQuery );
