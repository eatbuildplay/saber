<?php

namespace Saber\Lesson;

class LessonEditor {

  public function __construct() {

    /* metaboxes */
    add_action( 'admin_menu', [$this, 'metaboxes'] );
    add_action( 'save_post_lesson', [$this, 'metaboxSave'], 10, 2 );

    add_action('admin_enqueue_scripts', [$this, 'adminScripts']);

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

    $value = $_POST['lesson_overview'];
    $key = 'saber_lesson_overview';
    update_post_meta( $postId, $key, $value );

    $value = $_POST['lesson_duration'];
    $key = 'lesson_duration';
    update_post_meta( $postId, $key, $value );

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
    $template->path = 'components/lesson/templates/editor/';

    $content = '';

    $template->name = 'lesson-editor';
    $template->data = [
      'lesson' => $lesson
    ];
    $content .= $template->get();

    print $content;

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
