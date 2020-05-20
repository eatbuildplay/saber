<?php

namespace Saber\Course;

class CoursePostList extends \Saber\PostList {

  public $saberLoaderKey = 'coursePostList';
  public $loadHook = 'saber_post_list_load';

  public function __construct() {
    parent::__construct();
  }

  public function getShortcodeTag() {
    return 'course-post-list';
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
