<?php

namespace Saber\Course;

class CourseEditor {

  public function __construct() {

   add_action( 'admin_print_scripts-post-new.php', [$this, 'editorScript'] );
   add_action( 'admin_print_scripts-post.php', [$this, 'editorScript'] );

    /* metaboxes */
    add_action( 'admin_menu', [$this, 'metaboxes'] );
    add_action( 'save_post_course', [$this, 'metaboxSave'], 10, 2 );

    /* search ajax hook */
    add_action( 'wp_ajax_saber_course_editor_lesson_search', array( $this, 'jxLessonSearch'));
    add_action( 'wp_ajax_saber_course_editor_exam_search', array( $this, 'jxExamSearch'));

  }

  /*
   * Save metabox
   */
  public function metaboxSave( $postId, $post ) {

    $postType = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $postType->cap->edit_post, $postId )) {
      return $postId;
    }

    // course timeline data
    $key = 'saber_course_timeline_data';
    $value = $_POST['ceEditorData'];
    update_post_meta( $postId, $key, $value );

    // study guide
    $key = 'course_study_guide';
    $value = sanitize_text_field( $_POST[ $key ] );
    update_post_meta( $postId, $key, $value );

  }

  public function jxLessonSearch() {

    $search = $_POST['search'];

    // search for lessons
    $args = [
      's' => $search,
      'post_type' => 'lesson'
    ];
    $lessonPosts = \get_posts( $args );

    // form lesson array
    $lessons = [];
    foreach( $lessonPosts as $lessonPost ) {
      $lesson = new \stdClass;
      $lesson->id = $lessonPost->ID;
      $lesson->title = $lessonPost->post_title;
      $lessons[] = $lesson;
    }

    $response = [
      'code'    => 200,
      'lessons' => $lessons,
      'search' => $search
    ];
    print json_encode( $response );
    wp_die();

  }

  public function jxExamSearch() {

    $search = sanitize_text_field( $_POST['search'] );

    // search for lessons
    $args = [
      's' => $search,
      'post_type' => 'exam'
    ];
    $posts = \get_posts( $args );

    // form lesson array
    $exams = [];
    foreach( $posts as $post ) {
      $exam = new \stdClass;
      $exam->id = $post->ID;
      $exam->title = $post->post_title;
      $exams[] = $exam;
    }

    $response = [
      'code'    => 200,
      'exams' => $exams,
      'search' => $search
    ];

    print json_encode( $response );
    wp_die();

  }

  public function metaboxes() {

    add_meta_box(
  		'course_editor',
  		'Course Timeline',
  		[$this, 'metaboxCb'],
      'course',
  		'normal',
  		'high'
  	);

  }

  public function metaboxCb( $post ) {

    $course = \Saber\Course\Model\Course::Load( $post );
    $template = new \Saber\Template();
    $template->path = 'components/course/templates/editor/';

    $content = '';

    $template->name = 'editor-timeline';
    $template->data = [
      'course' => $course
    ];
    $content .= $template->get();

    print $content;

  }

  public function editorScript() {

    global $post_type;

    if( 'course' == $post_type ) {

      if ( !did_action( 'wp_enqueue_media' )) {
        wp_enqueue_media();
      }

      wp_enqueue_style(
        'saber-course-editor-css',
        SABER_URL . 'components/course/assets/course-editor.css',
        array(),
        '1.0.0',
        'all'
      );

      wp_enqueue_script(
        'saber-course-editor-js',
        SABER_URL . 'components/course/assets/course-editor.js',
        array( 'jquery', 'jquery-ui-droppable' ),
        '1.0.0',
        true
      );

    }
  }

}
