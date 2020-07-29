var Exam = {

  id: jQuery('#exam-canvas').data('exam-id'),
  canvas: {
    body: jQuery('#exam-body-canvas'),
    controls: jQuery('#exam-controls-canvas'),
  },
  exam: [],
  score: {
    id: 0
  },
  state: {
    started: false,
    currentQuestion: {
      index: 0,
      question: false
    }
  },

  init: function() {

    Exam.selectQuestionOption();
    Exam.examLoad();
    Exam.next();

    Exam.showStart();
    Exam.startClickHandler();

    Exam.restartClickHandler();

    Exam.viewScore();

  },

  viewScore: function() {
    jQuery(document).on( 'click', '.exam-control-view-score', function() {
      window.location.href = Exam.score.permalink;
    });
  },

  restartClickHandler: function() {
    jQuery(document).on('click', '.exam-control-restart', Exam.showStart);
  },

  timelineItemCount: function() {
    return Exam.exam.timeline.items.length;
  },

  end: function() {

    Exam.hideControls();

    var $template = jQuery('#exam-single-end').html();
    Exam.canvas.body.html( $template );

    // send end call
    data = {
      action: 'saber_exam_end',
      examId: Exam.id
    }
    jQuery.post( saber_post_list_load.ajaxurl, data, function( response ) {

      response = JSON.parse(response);

    });


  },

  showStart: function() {

    var $template = jQuery('#exam-single-start').html();
    Exam.canvas.body.html( $template );

  },

  startClickHandler: function() {
    jQuery(document).on('click', '.exam-control-start', Exam.start);
  },

  start: function() {

    // make ExamScore
    Exam.createExamScore();

    // show question
    var $question = Exam.exam.timeline.items[ 0 ];
    var $questionNumber = 1;
    Exam.questionShow( $question, $questionNumber );
    Exam.state.currentQuestion.index = 0;
    Exam.state.currentQuestion.question = $question;

    // show controls
    Exam.loadControls();
    Exam.showControls();

  },

  createExamScore: function() {

    data = {
      action: 'saber_exam_create_exam_score',
      examId: Exam.id
    }
    jQuery.post( saber_post_list_load.ajaxurl, data, function( response ) {

      response = JSON.parse(response);

      Exam.score.id = response.examScoreId;
      Exam.score.permalink = response.examScorePermalink;

    });

  },

  loadControls: function() {
    var $template = jQuery('#exam-controls').html();
    Exam.canvas.controls.html( $template );
  },

  showControls: function() {
    Exam.canvas.controls.show();
  },

  hideControls: function() {
    Exam.canvas.controls.hide();
  },

  showLastQuestion: function() {
    jQuery('button.exam-next').html('Finish Exam');
  },

  next: function() {

    jQuery(document).on('click', '.exam-next', function() {

      var $nextQuestionIndex = Exam.state.currentQuestion.index +1;
      var $question = Exam.exam.timeline.items[ $nextQuestionIndex ];

      // end is next
      if( Exam.timelineItemCount() == $nextQuestionIndex +1 ) {
        Exam.showLastQuestion();
      }

      // is end
      if( !$question ) {
        Exam.end();
        return;
      }

      var $questionNumber = $nextQuestionIndex +1;
      Exam.questionShow( $question, $questionNumber );
      Exam.state.currentQuestion.index = $nextQuestionIndex;
      Exam.state.currentQuestion.question = $question;

    });

  },

  /*
   * Load exam data via AJAX
   */
  examLoad: function() {

    data = {
      action: 'saber_exam_exam_load',
      examId: Exam.id
    }
    jQuery.post( saber_post_list_load.ajaxurl, data, function( response ) {

      response = JSON.parse(response);
      Exam.exam = response.exam;

    });

  },

  questionShow: function( $question, $questionNumber ) {

    console.log( $question );

    // populate templates
    var $template = jQuery('#question-template').html();
    $template = $template.replace(
      '{questionId}',
      $question.id
    );
    $template = $template.replace(
      '{questionTitle}',
      $question.title
    );
    $template = $template.replace(
      '{questionNumber}',
      'Question ' + $questionNumber
    );

    Exam.canvas.body.html( $template );

    // get the question as an element so we can make changes
    var $questionEl = jQuery('.question');

    var lettering = [
      'a', 'b', 'c', 'd', 'e', 'f'
    ];
    var $optionsHtml = '';
    $question.options.forEach( function( option, index ) {

      var $template = jQuery('#question-option-template').html();
      $template = $template.replace(
        /\{questionOptionId\}/g,
        option.id
      );

      $template = $template.replace(
        '{questionOptionLabel}',
        lettering[index] + ') ' + option.title
      );
      $template = $template.replace(
        '{questionId}',
        $question.id
      );
      $optionsHtml += $template;
    });

    $questionEl.find('ul').html( $optionsHtml );

  },

  selectQuestionOption: function() {

    jQuery( document ).on( 'click', '.question ul.selectable li', function() {

      // handle ux changes
      jQuery(this).addClass('selected');
      jQuery(this).parent('ul').removeClass('selectable');

      // record the answer
      var $questionId = jQuery(this).data('question-id');
      var $questionOptionId = jQuery(this).data('question-option-id');
      Exam.recordAnswer( $questionId, $questionOptionId );

    })

  },

  recordAnswer: function( $questionId, $questionOptionId ) {

    data = {
      action: 'saber_exam_record_answer',
      examScoreId: Exam.score.id,
      questionId: $questionId,
      questionOptionId: $questionOptionId
    }
    jQuery.post( saber_post_list_load.ajaxurl, data, function( response ) {

       response = JSON.parse(response);

       // add focus on answered question
       var $questionEl = jQuery('.question-' + response.question.id);
       $questionEl.addClass('focus');

       var $selectedOption = $questionEl.find('li.selected');

       if(response.isCorrect) {
         $selectedOption.addClass('correct');
       } else {
         $selectedOption.addClass('incorrect');
       }

    });

  }

}

Exam.init();
