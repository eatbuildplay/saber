<?php

namespace Saber\Exam;

class ExamSingleShortcode {

  public $tag = 'exam-single';

  public function __construct() {

    add_action('init', array( $this, 'init'));

    add_action( 'wp_ajax_saber_exam_record_answer', array( $this, 'jxRecordAnswer'));
    add_action( 'wp_ajax_saber_exam_question_load', array( $this, 'jxQuestionLoad'));
    add_action( 'wp_ajax_saber_exam_exam_load', array( $this, 'jxExamLoad'));
    add_action( 'wp_ajax_saber_exam_create_exam_score', array( $this, 'jxExamScoreCreate'));

  }

  public function jxRecordAnswer() {

    $examScoreId = $_POST['examScoreId'];

    // add QuestionAnswer
    $questionAnswer = new Model\QuestionAnswer();
    $questionAnswer->question = $_POST['questionId'];
    $questionAnswer->questionOption = $_POST['questionOptionId'];
    $questionAnswer->save();

    // add related ExamQuestionScore
    $scoreQuestion = new Model\ExamScoreQuestion();
    $scoreQuestion->title = "ESQ-".time();
    $scoreQuestion->examScore = $examScoreId;
    $scoreQuestion->questionAnswer = $questionAnswer;

    // do marking
    $isCorrect = false;
    $questionPost = get_post( $questionAnswer->question );
    $question = Model\Question::load( $questionPost );
    if( $questionAnswer->questionOption == $question->correct->id ) {
      $isCorrect = true;
    }
    $scoreQuestion->correct = $isCorrect;

    // award point(s)
    if( $isCorrect ) {
      $scoreQuestion->points = 1;
    }
    $scoreQuestion->save();

    $response = array(
      'isCorrect' => $isCorrect,
      'question' => $question,
      'message' => 'Your answer was marked.'
    );
    print json_encode( $response );

    wp_die();

  }

  public function jxExamScoreCreate() {

    $examId = $_POST['examId'];

    // create exam score
    $examScore = new \Saber\Exam\Model\ExamScore;
    $examScore->exam = $examId;
    $examScore->save();

    $response = array(
      'examScoreId' => $examScore->id
    );
    print json_encode( $response );

    wp_die();

  }

  public function jxExamLoad() {

    $examId = $_POST['examId'];
    $exam = Model\Exam::load( $examId );

    $response = array(
      'exam' => $exam
    );
    print json_encode( $response );

    wp_die();

  }

  public function jxQuestionLoad() {

    $questionId = $_POST['questionId'];
    $question = Model\Question::load( $questionId );

    $response = array(
      'question' => $question
    );
    print json_encode( $response );

    wp_die();

  }

  public function init() {
    add_shortcode($this->tag, array($this, 'doShortcode'));
  }

  public function doShortcode( $atts ) {

    global $post;
    $examFields = get_fields( $post->ID );

    $exam = Model\Exam::load( $post );

    $template = new \Saber\Template();
    $template->path = 'components/exam/templates/';

    $content = '';

    // main template
    $template->name = 'exam-single';
    $template->data = array(
      'exam' => $exam,
      'examFields' => $examFields
    );
    $content .= $template->get();

    // exam controls template
    $template->name = 'exam-single-controls';
    $template->data = array();
    $content .= $template->get();

    // question template
    $template->name = 'question-single';
    $content .= $template->get();

    // question options template
    $template->name = 'question-option-single';
    $content .= $template->get();

    // start screen template
    $template->name = 'exam-single-start';
    $template->data = array();
    $content .= $template->get();

    // end screen template
    $template->name = 'exam-single-end';
    $template->data = array();
    $content .= $template->get();

    return $content;

  }

}
