<?php

namespace Saber\Course;

class CourseComponent {

  public function __construct() {

    require_once( SABER_PATH . 'components/course/src/CourseEditor.php' );
    new CourseEditor();

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

    wp_enqueue_style(
      'saber-video-js',
      'https://vjs.zencdn.net/7.8.3/video-js.css',
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

    // video.js
    wp_enqueue_script(
      'saber-videojs',
      'https://vjs.zencdn.net/7.8.3/video.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

    wp_enqueue_script(
      'saber-course-single',
      SABER_URL . 'components/course/assets/course-single.js',
      array( 'jquery', 'saber-videojs', 'exam-js' ),
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
