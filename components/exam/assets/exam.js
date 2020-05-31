(function($) {

var Exam = {

  id: $('#exam-canvas').data('exam-id'),
  canvas: {
    body: $('#exam-body-canvas'),
    controls: $('#exam-controls-canvas'),
  },
  exam: [],
  score: {
    id: 0
  },
  questions: [],
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
    $(document).on( 'click', '.exam-control-view-score', function() {
      window.location.href = Exam.score.permalink;
    });
  },

  restartClickHandler: function() {
    $(document).on('click', '.exam-control-restart', Exam.showStart);
  },

  questionCount: function() {
    return Exam.questions.length;
  },

  end: function() {

    Exam.hideControls();

    var $template = $('#exam-single-end').html();
    Exam.canvas.body.html( $template );

  },

  showStart: function() {

    var $template = $('#exam-single-start').html();
    Exam.canvas.body.html( $template );

  },

  startClickHandler: function() {
    $(document).on('click', '.exam-control-start', Exam.start);
  },

  start: function() {

    // make ExamScore
    Exam.createExamScore();

    // show question
    var $question = Exam.questions[ 0 ];
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
    $.post( saber_post_list_load.ajaxurl, data, function( response ) {

      response = JSON.parse(response);
      console.log( response );

      Exam.score.id = response.examScoreId;
      Exam.score.permalink = response.examScorePermalink;

    });

  },

  loadControls: function() {
    var $template = $('#exam-controls').html();
    Exam.canvas.controls.html( $template );
  },

  showControls: function() {
    Exam.canvas.controls.show();
  },

  hideControls: function() {
    Exam.canvas.controls.hide();
  },

  showLastQuestion: function() {
    $('button.exam-next').html('Finish Exam');
  },

  next: function() {

    $(document).on('click', '.exam-next', function() {

      var $nextQuestionIndex = Exam.state.currentQuestion.index +1;
      var $question = Exam.questions[ $nextQuestionIndex ];

      // end is next
      if( Exam.questionCount() == $nextQuestionIndex +1 ) {
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
    $.post( saber_post_list_load.ajaxurl, data, function( response ) {

      response = JSON.parse(response);
      Exam.exam = response.exam;
      Exam.questions = response.exam.questions;

    });

  },

  questionShow: function( $question, $questionNumber ) {

    // populate templates
    var $template = $('#question-template').html();
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
    var $questionEl = $('.question');

    var lettering = [
      'a', 'b', 'c', 'd', 'e', 'f'
    ];
    var $optionsHtml = '';
    $question.options.forEach( function( option, index ) {
      var $template = $('#question-option-template').html();

      console.log(option);

      console.log( $template );
      $template = $template.replace(
        /\{questionOptionId\}/g,
        option.id
      );
      console.log( $template );


      $template = $template.replace(
        '{questionOptionLabel}',
        lettering[index] + ') ' + option.label
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

    $( document ).on( 'click', '.question ul.selectable li', function() {

      // handle ux changes
      $(this).addClass('selected');
      $(this).parent('ul').removeClass('selectable');

      // record the answer
      var $questionId = $(this).data('question-id');
      var $questionOptionId = $(this).data('question-option-id');
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
    $.post( saber_post_list_load.ajaxurl, data, function( response ) {

       response = JSON.parse(response);
       console.log( response );

       // add focus on answered question
       var $questionEl = $('.question-' + response.question.id);
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

})( jQuery );
