<?php

namespace Saber\Lesson;

class LessonComponent {

  public function __construct() {

    add_action('wp_ajax_saber_lesson_list_load', [$this, 'jxListLoad']);
    add_action('wp_ajax_nopriv_saber_lesson_list_load', [$this, 'jxListLoad']);

    require_once( SABER_PATH . 'components/lesson/src/models/Lesson.php' );

    require_once( SABER_PATH . 'components/lesson/src/LessonSingleShortcode.php' );
    new LessonSingleShortcode();

    require_once( SABER_PATH . 'components/lesson/src/LessonPostList.php' );
    new LessonPostList();

    add_action('init', [$this, 'registerPostTypes']);

    add_action('wp_enqueue_scripts', [$this, 'addScripts']);
    add_action('admin_enqueue_scripts', [$this, 'adminScripts']);


    // track view lesson
    add_action('wp', [$this, 'trackView']);
    add_action( 'wp_ajax_saber_exercise_view', array( $this, 'jxTrackExerciseView'));

    /* metaboxes */
    add_action( 'admin_menu', [$this, 'metaboxes'] );
    add_action( 'save_post_lesson', [$this, 'metaboxSave'], 10, 2 );

  }

  public function metaboxSave( $postId, $post ) {

    $postType = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $postType->cap->edit_post, $postId )) {
      return $postId;
    }

    $newValue = $_POST['lessonVideo'];

    $key = 'saber_lesson_video';
    $value = get_post_meta( $postId, $key, true );

    update_post_meta( $postId, $key, $newValue );

  }

  public function metaboxes() {

    add_meta_box(
  		'lesson_editor', // metabox ID
  		'Lesson Content', // title
  		[$this, 'metaboxCb'], // callback
  		'lesson',
  		'normal', // position
  		'high' // priority
  	);

  }

  public function metaboxCb( $post ) {

    $lesson = \Saber\Lesson\Model\Lesson::Load( $post );
    $template = new \Saber\Template();
    $template->path = 'components/lesson/templates/';

    $content = '';

    $template->name = 'lesson-editor';
    $template->data = [
      'lesson' => $lesson
    ];
    $content .= $template->get();

    print $content;

  }

  public function jxTrackExerciseView() {

    $lessonId = intval( $_POST['lessonId'] );
    $exercise = sanitize_text_field( $_POST['exercise'] );

    $tracker = new \Saber\Intel\Tracker;
    $tracker->setObject('lesson', $lessonId);
    $tracker->trackType = 'view';
    $tracker->trackData = [
      'type' => $exercise,
      'timestamp' => time()
    ];
    $tracker->save();

    // no response
    print 1;
    wp_die();

  }

  public function trackView() {

    global $post;
    if( $post->post_type != 'lesson' ) {
      return;
    }

    $tracker = new \Saber\Intel\Tracker;
    $tracker->setObject('lesson', $post->ID);
    $tracker->trackType = 'view';
    $tracker->trackData = [
      'type' => 'main',
      'timestamp' => time()
    ];
    $tracker->save();

    // var_dump( $tracker->fetch() );

  }

  public function registerPostTypes() {

    require_once( SABER_PATH . 'components/lesson/src/cpt/LessonPostType.php' );
    $pt = new LessonPostType();
    $pt->register();

  }

  public function addScripts() {

    global $post;
    if( $post->post_type != 'lesson' ):
      return;
    endif;

    wp_enqueue_style(
      'saber-lesson-style',
      SABER_URL . 'components/lesson/assets/lesson.css',
      array(),
      '1.0.0',
      'all'
    );

    wp_enqueue_script(
      'saber-lesson-js',
      SABER_URL . 'components/lesson/assets/lesson.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );



  }

  public function adminScripts() {

    if ( !did_action( 'wp_enqueue_media' )) {
  		wp_enqueue_media();
  	}

    wp_enqueue_script(
      'saber-lesson-editor',
      SABER_URL . 'components/lesson/assets/lesson-editor.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

  }

}
