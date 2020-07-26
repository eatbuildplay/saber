<?php

namespace Saber\Lesson;

class LessonSingleShortcode {

  public $tag = 'lesson-single';

  public function __construct() {
    add_action('init', array( $this, 'init'));
  }

  public function init() {
    add_shortcode($this->tag, array($this, 'doShortcode'));
  }

  public function doShortcode( $atts ) {

    global $post;
    // $lessonFields = get_fields( $post->ID );
    $lesson = Model\Lesson::load( $post );

    // get next lesson
    $nextLesson = false; // default false
    $lessons = get_posts([
      'post_type'   => 'lesson',
      'orderby'     => 'meta_value_num',
      'order'       => 'ASC',
      'meta_key'    => 'display_order',
      'meta_query'  => [
        [
          'key'     => 'display_order',
          'value'   => $lessonFields['display_order'],
          'compare' => '>'
        ],
        [
          'key'     => 'course',
          'value'   => $lessonFields['course'],
          'compare' => '='
        ]
      ]
    ]);
    if( !empty( $lessons )) {
      $nextLesson = $lessons[0];
      $nextLesson->url = get_permalink( $nextLesson );
    }

    // localize lesson data
    wp_localize_script(
      'saber-lesson-js',
      'saberLesson',
      [
        'lesson'      => $lesson,
        'fields'      => $lessonFields,
        'post'        => $lesson,
        'nextLesson'  => $nextLesson
      ]
    );

    $template = new \Saber\Template();
    $template->path = 'components/lesson/templates/';

    $content = '';

    // lesson header
    $template->name = 'lesson-single-header';
    $template->data = array(
      'lesson' => $lesson
    );
    $content .= $template->get();

    // tabs
    $template->name = 'lesson-single-tabs';
    $template->data = array(
      'lesson' => $lesson
    );
    $content .= $template->get();

    // wordscan
    $template->name = 'lesson-single-wordscan';
    $template->data = array(
      'lesson' => $lesson,
      'lessonFields' => $lessonFields
    );
    $content .= $template->get();

    // flashcards
    $template->name = 'lesson-single-flashcards';
    $template->data = array(
      'lessonFields' => $lessonFields
    );
    $content .= $template->get();

    // word selection
    $template->name = 'lesson-single-word-selection';
    $template->data = array(
      'lessonFields' => $lessonFields
    );
    $content .= $template->get();

    // conversation
    if( $lesson->conversation ):
      $template->name = 'lesson-single-conversations';
      $template->data = array(
        'lesson' => $lesson
      );
      $content .= $template->get();
    endif;

    // exam
    $template->name = 'lesson-single-exam';
    $template->data = array(
      'lesson' => $lesson
    );
    $content .= $template->get();

    // footer
    $template->name = 'lesson-single-footer';
    $template->data = array(
      'lesson' => $lesson
    );
    $content .= $template->get();

    return $content;

  }

}
