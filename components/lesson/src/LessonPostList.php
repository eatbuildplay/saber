<?php

namespace Frame\Lesson;

class LessonPostList extends \Frame\PostList {

  public $frameLoaderKey = 'lessonPostList';
  public $loadHook = 'frame_lesson_list_load';

  public function __construct() {
    parent::__construct();
  }

  public function getPostType() {
    return 'lesson';
  }

  public function getShortcodeTag() {
    return 'lesson-post-list';
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
