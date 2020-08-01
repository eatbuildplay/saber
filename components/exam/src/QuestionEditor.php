<?php

namespace Saber\Exam;

class QuestionEditor {

  public function __construct() {

    /* metaboxes */
    add_action( 'admin_menu', [$this, 'metaboxes'] );
    add_action( 'save_post_question', [$this, 'metaboxSave'], 10, 2 );

    /* search ajax hook */
    add_action( 'wp_ajax_saber_question_editor_question_search', array( $this, 'jxQuestionSearch'));

    add_action( 'admin_print_scripts-post-new.php', [$this, 'editorScripts'] );
    add_action( 'admin_print_scripts-post.php', [$this, 'editorScripts'] );

  }

  public function metaboxes() {

    add_meta_box(
  		'question_editor', // metabox ID
  		'Question Editor', // title
  		[$this, 'metaboxCb'], // callback
  		'question',
  		'normal', // position
  		'high' // priority
  	);

  }

  public function metaboxCb( $post ) {

    $question = \Saber\Exam\Model\Question::Load( $post );
    $template = new \Saber\Template();
    $template->path = 'components/exam/templates/question-editor/';

    $content = '';

    $template->name = 'question-editor';
    $template->data = [
      'question' => $question
    ];
    $content .= $template->get();

    $template->name = 'options-list';
    $content .= $template->get();

    wp_localize_script(
      'question-editor',
      'saberData',
      [ 'question' => $question ]
    );

    print $content;

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

    $value = $_POST['question_type'];
    update_post_meta(
      $postId,
      'question_type',
      $value
    );

    $value = $_POST['question_body'];
    update_post_meta(
      $postId,
      'question_body',
      $value
    );

    $optionsPassed = $_POST['question_options'];
    $optionsStripSlashed = stripslashes( $optionsPassed );
    $optionsRaw = json_decode( $optionsStripSlashed );

    $correct = [];

    if( empty( $optionsRaw )) {

      $optionIds = [];

    } else {

      $optionIds = [];
      foreach( $optionsRaw as $opt ) {

        if( $opt->id == 0 ) {
          $optionModel = new \Saber\Exam\Model\QuestionOption;
        } else {
          $optionModel = \Saber\Exam\Model\QuestionOption::load( $opt->id );
        }

        $optionModel->title = $opt->title;
        $optionModel->label = $opt->title;
        $optionModel->correct = $opt->correct;
        $optionModel->save();
        $optionIds[] = $optionModel->id;

        if( $opt->correct ) {
          $correct[] = $optionModel->id;
        }

      }

    }

    update_post_meta(
      $postId,
      'question_options',
      $optionIds
    );

    update_post_meta($postId, 'question_correct', $correct);

  }

  public function editorScripts() {

    global $post_type;

    if( 'question' == $post_type ) {

      wp_enqueue_script(
        'question-editor',
        SABER_URL . 'components/exam/assets/question-editor.js',
        array( 'jquery' ),
        '1.0.0',
        true
      );

      wp_enqueue_style(
        'question-editor',
        SABER_URL . 'components/exam/assets/question-editor.css',
        array(),
        true
      );

    }

  }

}
