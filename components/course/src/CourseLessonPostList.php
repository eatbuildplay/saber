<?php

namespace Saber\Course;

class CourseLessonPostList extends \Saber\PostList {

  public $loadHook = 'course_lesson_post_list_load';

  public function __construct() {
    parent::__construct();
  }

  public function getPostType() {
    return 'lesson';
  }

  public function getShortcodeTag() {
    return 'course-lesson-post-list';
  }

  public function listItemTemplate() {

    $template = new \Saber\Template();
    $template->path = 'components/course/templates/';
    $template->name = 'course-lesson-list-item';
    return $template;

  }

  public function metaQuery( $postId ) {

    $metaquery = [
      [
        'key'     => 'course',
        'value'   => $postId,
        'compare' => '='
      ]
    ];

    return $metaquery;

  }

  public function order() {
    return [
      'orderby' => 'meta_value_num',
      'order'   => 'ASC'
    ];
  }

  public function setMetakey() {
    return 'display_order';
  }

}
