<?php

namespace Saber\Course;

class CourseComponent {

  public function __construct() {

    require_once( SABER_PATH . 'components/course/src/CoursePostList.php' );
    new CoursePostList();

    require_once( SABER_PATH . 'components/course/src/CourseLessonPostList.php' );
    new CourseLessonPostList();

    require_once( SABER_PATH . 'components/course/src/models/Course.php' );

    require_once( SABER_PATH . 'components/course/src/shortcodes/CourseSingleHeaderShortcode.php' );
    new CourseSingleHeaderShortcode();

    add_action('init', [$this, 'registerPostTypes']);
    add_action('init', [$this, 'registerFields']);

    /* script calls */
    add_action('wp_enqueue_scripts', [$this, 'scripts']);

    /*
     * Course editor
     */
   add_action( 'admin_print_scripts-post-new.php', [$this, 'editorScript'] );
   add_action( 'admin_print_scripts-post.php', [$this, 'editorScript'] );

    /* metaboxes */
    add_action( 'admin_menu', [$this, 'metaboxes'] );

    add_action( 'wp_ajax_saber_course_editor_lesson_search', array( $this, 'jxLessonSearch'));

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

  public function metaboxes() {

    add_meta_box(
  		'course_editor', // metabox ID
  		'Course Timeline', // title
  		[$this, 'metaboxCb'], // callback
  		'course',
  		'normal', // position
  		'high' // priority
  	);

  }

  public function editorScript() {
    global $post_type;

    if( 'course' == $post_type ) {

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

  public function metaboxCb( $post ) {

    $template = new \Saber\Template();
    $template->path = 'components/course/templates/';

    $content = '';

    $template->name = 'editor-timeline';
    $template->data = [];
    $content .= $template->get();

    print $content;

  }

  public function registerPostTypes() {

    require_once( SABER_PATH . 'components/course/src/cpt/CoursePostType.php' );
    $pt = new CoursePostType();
    $pt->register();

  }

  public function registerFields() {
    require_once( SABER_PATH . 'components/course/assets/fields/fields.php' );
  }

  public function scripts() {

    wp_enqueue_style(
      'saber-course-css',
      SABER_URL . 'components/course/assets/course.css',
      array(),
      '1.0.0',
      'all'
    );

    wp_enqueue_script(
      'saber-course-js',
      SABER_URL . 'components/course/assets/course.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

  }

}
