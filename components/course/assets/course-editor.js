(function($) {

  var courseEditor = {

    data: {
      timeline: []
    }, // stores the course data

    init: function() {

      // init study guide field
      courseEditor.initStudyGuideField();

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

      /* lesson search handler */
      $('#ceLessonSearchButton').on('click', function() {
        courseEditor.searchLessons();
      });

      /* exam search handler */
      $('#ceExamSearchButton').on('click', function() {
        courseEditor.searchExams();
      });

      /* Click on option returned from search */
      $(document).on('click', '.clickable-option', function() {

        var data = {};
        data.type = $(this).data('type');
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
          type: data.type,
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

    emptySearchHandlerLessons: function() {
      var msg = '<div class="course-editor-empty-search">';
      msg +=    'No results found, please try a different search term.';
      msg +=    '</div>';
      $('#ceLessonSearchResults').append( msg );
    },

    emptySearchHandlerExams: function() {
      var msg = '<div class="course-editor-empty-search">';
      msg +=    'No exams found, please try a different search term.';
      msg +=    '</div>';
      $('#ceExamSearchResults').append( msg );
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

      if( data.type == 'exam' ) {
        var timelineItem = '<div class="course-editor-timeline-item course-editor-timeline-item-exam" data-id="' + data.id + '" data-type="lesson">';
      } else {
        var timelineItem = '<div class="course-editor-timeline-item" data-id="' + data.id + '" data-type="lesson">';
      }
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

    },

    searchLessons: function() {

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

          if( response.lessons.length == 0 ) {
            courseEditor.emptySearchHandlerLessons();
            return;
          }

          response.lessons.forEach( function( lesson ) {

            var clickableOption = '<div class="clickable-option" data-id="' + lesson.id + '" data-type="lesson">';
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

    },

    searchExams: function() {

      data = {
        action: 'saber_course_editor_exam_search',
        search: $('#examSearchBox').val(),
      }
      $.post(
        ajaxurl,
        data,
        function( response ) {

          $('#ceExamSearchResults').html('');
          response = JSON.parse(response);

          if( response.exams.length == 0 ) {
            console.log('empty!!')
            courseEditor.emptySearchHandlerExams();
            return;
          }

          response.exams.forEach( function( exam ) {

            var clickableOption = '<div class="clickable-option" data-id="' + exam.id + '" data-type="exam">';
            clickableOption += '<h4>' + exam.title + '</h4>';
            clickableOption += '</div>';

            $('#ceExamSearchResults').append( clickableOption );

          });

          var clearButton = '<button class="ce-search-clear">';
          clearButton += 'Clear';
          clearButton += '</button>';
          $('#ceExamSearchResults').append( clearButton );

        }
      );

    },

    initStudyGuideField: function() {

			var inputEl = $('#course_study_guide');

      console.log( inputEl );

			// initial load state handling
			if( inputEl.val() == '' ) {
				inputEl.after('<button class="saber-uploader">Add Video</button>');
			} else {
				inputEl.after('<button class="saber-uploader-remove">Remove Video</button>');
				inputEl.after('<button class="saber-uploader">Change Video</button>');
				inputEl.after('<span class="saber-uploader-title">' + inputEl.data('filename')  + '</span>');
			}

			// add video click
			$(document).on( 'click', '.saber-uploader', function(e) {

				e.preventDefault();

				var button = $(this);

				// see https://core.trac.wordpress.org/browser/tags/5.4.2/src/js/_enqueues/wp/media/models.js#L0
				var uploader = wp.media({
					title: 'Add Video',
					library : {
						// uploadedTo : wp.media.view.settings.post.id, // attach to the current post?
						// type : 'image'
					},
					button: {
						text: '+ Add Video' // button label text
					},
					multiple: false
				}).on('select', function() { // it also has "open" and "close" events
					var attachment = uploader.state().get('selection').first().toJSON();

					console.log( attachment );

					$('.saber-uploader-title').text( attachment.filename ).show();
					button.text('Change Video');
					$('.saber-uploader-remove').show();

		      inputEl.val( attachment.id );

				}).open();

			});

			// on remove button click
			$(document).on('click', '.saber-uploader-remove', function(e){

				e.preventDefault();

				var button = $(this);
		    button.hide();
				inputEl.val(''); // emptying the hidden field
				$('.saber-uploader-title').hide();
				$('.saber-uploader').text('Add Video');

			});

		}

  } // end courseEditor


  // init
  courseEditor.init();

})( jQuery );
