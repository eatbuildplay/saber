<?php

namespace Saber\Course;

class CoursePostList extends \Saber\PostList {

  public $saberLoaderKey = 'coursePostList';
  public $loadHook = 'saber_post_list_load';

  public function __construct() {
    parent::__construct();
  }

  public function getPostType() {
    return 'course';
  }

  public function getShortcodeTag() {
    return 'course-post-list';
  }

  public function listTemplate() {

    $template = new \Saber\Template();
    $template->path = 'components/course/templates/';
    $template->name = 'course-list';
    return $template;

  }

  public function listItemTemplate() {

    $template = new \Saber\Template();
    $template->path = 'components/course/templates/';
    $template->name = 'course-list-item';
    return $template;

  }

  public function listItemData( $data ) {

    $course = $data['model'];
    $student = \Saber\Student\Model\Student::load();
    $cr = new \Saber\Register\Model\CourseRegistration;
    $courseRegistration = $cr->fetch( $student, $course );
    $data['courseRegistration'] = $courseRegistration;
    return $data;

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
