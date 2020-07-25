<?php

namespace Saber\Exam;

class ExamEditor {

  public function __construct() {

    /* metaboxes */
    add_action( 'admin_menu', [$this, 'metaboxes'] );
    //add_action( 'save_post_course', [$this, 'metaboxSave'], 10, 2 );

    /* search ajax hook */
    //add_action( 'wp_ajax_saber_course_editor_lesson_search', array( $this, 'jxLessonSearch'));
    //add_action( 'wp_ajax_saber_course_editor_exam_search', array( $this, 'jxExamSearch'));

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

}
