<?php

namespace Saber\Exam;

class Exam {

  public function __construct() {

    add_action('init', [$this, 'registerPostTypes']);
    add_action('init', [$this, 'registerFields']);

    require_once( SABER_PATH . 'components/exam/src/shortcodes/ExamSingleShortcode.php' );
    new ExamSingleShortcode();

    // load models
    require_once( SABER_PATH . 'components/exam/src/models/Exam.php' );
    require_once( SABER_PATH . 'components/exam/src/models/ExamList.php' );
    require_once( SABER_PATH . 'components/exam/src/models/ExamScore.php' );
    require_once( SABER_PATH . 'components/exam/src/models/ExamScoreList.php' );
    require_once( SABER_PATH . 'components/exam/src/models/ExamScoreQuestion.php' );
    require_once( SABER_PATH . 'components/exam/src/models/ExamScoreQuestionList.php' );
    require_once( SABER_PATH . 'components/exam/src/models/Question.php' );
    require_once( SABER_PATH . 'components/exam/src/models/QuestionList.php' );
    require_once( SABER_PATH . 'components/exam/src/models/QuestionOption.php' );
    require_once( SABER_PATH . 'components/exam/src/models/QuestionOptionList.php' );
    require_once( SABER_PATH . 'components/exam/src/models/QuestionAnswer.php' );
    require_once( SABER_PATH . 'components/exam/src/models/QuestionAnswerList.php' );

    add_action('wp_enqueue_scripts', array( $this, 'scripts' ));

    add_filter('single_template', [$this, 'singlePageTemplates'] );
    add_action('wp', [$this, 'setGlobals']);

  }

  public function setGlobals() {

    global $post;

    if ( is_object($post) && $post->post_type == 'exam_score' ) {
      $GLOBALS['examScore'] = Model\ExamScore::load( $post );
    }

  }

  public function singlePageTemplates( $single ) {

    global $post;

    if ( $post->post_type == 'exam_score' ) {
      return SABER_PATH . 'components/exam/templates/singles/exam_score.php';
    }

    return $single;

  }

  public function scripts() {

    wp_enqueue_script(
      'exam-js',
      SABER_URL . 'components/exam/assets/exam.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

    wp_enqueue_style(
      'exam-css',
      SABER_URL . 'components/exam/assets/exam.css',
      array(),
      true
    );

  }

  public function registerFields() {
    require_once( SABER_PATH . 'components/exam/assets/fields.php' );
  }

  public function registerPostTypes() {

    require_once( SABER_PATH . 'components/exam/src/cpt/ExamPostType.php' );
    $pt = new ExamPostType();
    $pt->register();

    require_once( SABER_PATH . 'components/exam/src/cpt/ExamScorePostType.php' );
    $pt = new ExamScorePostType();
    $pt->register();

    require_once( SABER_PATH . 'components/exam/src/cpt/ExamScoreQuestionPostType.php' );
    $pt = new ExamScoreQuestionPostType();
    $pt->register();

    require_once( SABER_PATH . 'components/exam/src/cpt/ExamSectionPostType.php' );
    $pt = new ExamSectionPostType();
    $pt->register();

    require_once( SABER_PATH . 'components/exam/src/cpt/QuestionPostType.php' );
    $pt = new QuestionPostType();
    $pt->register();

    require_once( SABER_PATH . 'components/exam/src/cpt/QuestionTypePostType.php' );
    $pt = new QuestionTypePostType();
    $pt->register();

    require_once( SABER_PATH . 'components/exam/src/cpt/QuestionAnswerPostType.php' );
    $pt = new QuestionAnswerPostType();
    $pt->register();

    require_once( SABER_PATH . 'components/exam/src/cpt/QuestionOptionPostType.php' );
    $pt = new QuestionOptionPostType();
    $pt->register();

    require_once( SABER_PATH . 'components/exam/src/cpt/QuestionBankPostType.php' );
    $pt = new QuestionBankPostType();
    $pt->register();

  }

}
