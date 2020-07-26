<?php

namespace Saber\Exam;

class ExamEditor {

  public function __construct() {

    /* metaboxes */
    add_action( 'admin_menu', [$this, 'metaboxes'] );
    //add_action( 'save_post_course', [$this, 'metaboxSave'], 10, 2 );

    /* search ajax hook */
    add_action( 'wp_ajax_saber_exam_editor_question_search', array( $this, 'jxQuestionSearch'));

    add_action('admin_enqueue_scripts', array( $this, 'scripts' ));


  }

  public function jxQuestionSearch() {

    $search = $_POST['search'];

    // search for lessons
    $args = [
      's' => $search,
      'post_type' => 'question'
    ];
    $posts = \get_posts( $args );

    // form lesson array
    $models = [];
    foreach( $posts as $post ) {
      $model = new \stdClass;
      $model->id = $post->ID;
      $model->title = $post->post_title;
      $models[] = $model;
    }

    $response = [
      'code'    => 200,
      'items'   => $models,
      'search'  => $search
    ];
    print json_encode( $response );
    wp_die();

  }

  public function metaboxes() {

    add_meta_box(
  		'exam_editor', // metabox ID
  		'Exam Editor', // title
  		[$this, 'metaboxCb'], // callback
  		'exam',
  		'normal', // position
  		'high' // priority
  	);

  }

  public function metaboxCb( $post ) {

    $exam = \Saber\Exam\Model\Exam::Load( $post );
    $template = new \Saber\Template();
    $template->path = 'components/exam/templates/';

    $content = '';

    $template->name = 'exam-editor';
    $template->data = [
      'exam' => $exam
    ];
    $content .= $template->get();

    print $content;

  }

  public function scripts() {

    wp_enqueue_script(
      'exam-editor',
      SABER_URL . 'components/exam/assets/exam-editor.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

    wp_enqueue_style(
      'exam-editor',
      SABER_URL . 'components/exam/assets/exam-editor.css',
      array(),
      true
    );

  }

}
