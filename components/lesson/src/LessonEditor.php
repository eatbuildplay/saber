<?php

namespace Saber\Lesson;

class LessonEditor {

  public function __construct() {

    /* metaboxes */
    add_action( 'admin_menu', [$this, 'metaboxes'] );
    add_action( 'save_post_lesson', [$this, 'metaboxSave'], 10, 2 );

    add_action( 'admin_print_scripts-post-new.php', [$this, 'editorScripts'] );
    add_action( 'admin_print_scripts-post.php', [$this, 'editorScripts'] );

  }

  public function metaboxSave( $postId, $post ) {

    $postType = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $postType->cap->edit_post, $postId )) {
      return $postId;
    }

    $key = 'lesson_video';
    $value = sanitize_text_field( $_POST[ $key ] );
    update_post_meta( $postId, $key, $value );

    $key = 'lesson_overview';
    $value = sanitize_text_field( $_POST[ $key ] );
    update_post_meta( $postId, $key, $value );

    $key = 'lesson_duration';
    $value = sanitize_text_field( $_POST[ $key ] );
    update_post_meta( $postId, $key, $value );

    $key = 'lesson_professor';
    $value = sanitize_text_field( $_POST[ $key ] );
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

    $professors = $this->loadProfessorsList();

    $template->name = 'lesson-editor';
    $template->data = [
      'lesson' => $lesson,
      'professors' => $professors
    ];
    $content .= $template->get();

    print $content;

  }

  public function loadProfessorsList() {

    $args = [
      'role__in' => [
        'administrator',
        'editor',
        'author'
      ]
    ];

    return get_users( $args );

  }

  public function editorScripts() {

    global $post_type;

    if( 'lesson' == $post_type ) {

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

}
