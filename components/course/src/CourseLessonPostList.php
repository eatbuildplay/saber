<?php

namespace Frame\Course;

class CourseLessonPostList extends \Frame\PostList {

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
