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

    /* script calls */
    add_action('wp_enqueue_scripts', [$this, 'scripts']);

    /*
     * Course editor
     */
   add_action( 'admin_print_scripts-post-new.php', [$this, 'editorScript'] );
   add_action( 'admin_print_scripts-post.php', [$this, 'editorScript'] );

    /* metaboxes */
    add_action( 'admin_menu', [$this, 'metaboxes'] );
    add_action( 'save_post_course', [$this, 'metaboxSave'], 10, 2 );

    /* search ajax hook */
    add_action( 'wp_ajax_saber_course_editor_lesson_search', array( $this, 'jxLessonSearch'));
    add_action( 'wp_ajax_saber_course_editor_exam_search', array( $this, 'jxExamSearch'));

    /* single templates */
    add_action('wp', [$this, 'setGlobals']);
    add_filter('single_template', [$this, 'singlePageTemplates'] );

  }

  public function singlePageTemplates( $single ) {

    global $post;

    if ( $post->post_type == 'course' ) {
      return SABER_PATH . 'components/course/templates/singles/course.php';
    }

    return $single;

  }

  public function setGlobals() {

    global $post;

    if ( !is_object($post) || $post->post_type != 'course' ) {
      return;
    }

    $course = Model\Course::load( $post );
    $GLOBALS['course'] = $course;

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

    $newValue = $_POST['ceEditorData'];

    $key = 'saber_course_timeline_data';
    $value = get_post_meta( $postId, $key, true );

    update_post_meta( $postId, $key, $newValue );

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

    $search = $_POST['search'];

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

    $course = \Saber\Course\Model\Course::Load( $post );
    $template = new \Saber\Template();
    $template->path = 'components/course/templates/';

    $content = '';

    $template->name = 'editor-timeline';
    $template->data = [
      'course' => $course
    ];
    $content .= $template->get();

    print $content;

  }

  public function registerPostTypes() {

    require_once( SABER_PATH . 'components/course/src/cpt/CoursePostType.php' );
    $pt = new CoursePostType();
    $pt->register();

  }

  public function scripts() {

    wp_enqueue_style(
      'saber-course-css',
      SABER_URL . 'components/course/assets/course.css',
      array(),
      '1.0.0',
      'all'
    );

    wp_enqueue_style(
      'saber-course-single',
      SABER_URL . 'components/course/assets/course-single.css',
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

    wp_enqueue_script(
      'saber-course-single',
      SABER_URL . 'components/course/assets/course-single.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

    // localize course
    if( isset( $GLOBALS['course'] )) {
      wp_localize_script(
        'saber-course-js',
        'saberCourse',
        [
          'course' => $GLOBALS['course']
        ]
      );
    }

  }

}
