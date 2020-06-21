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

  public function listTemplate() {

    $template = new \Saber\Template();
    $template->path = 'components/course/templates/';
    $template->name = 'course-lesson-list';
    return $template;

  }

  public function listItemTemplate() {

    $template = new \Saber\Template();
    $template->path = 'components/course/templates/';
    $template->name = 'course-lesson-list-item';
    return $template;

  }

  public function listItemData( $data ) {

    // add current lesson variable to each list item
    $lesson = $data['model'];
    $trackerCourse = new \Saber\Intel\TrackerCourse();
    $trackerCourse->setObject('course', $lesson->course->id);
    $tracker = $trackerCourse->fetch();
    $currentLesson = $tracker->current_lesson;

    if( $currentLesson == $lesson->id ) {
      $data['isCurrentLesson'] = 1;
    } else {
      $data['isCurrentLesson'] = 0;
    }

    // add completed lesson to each item
    if( in_array( $lesson->id, $tracker->lessons_completed )) {
      $data['isCompletedLesson'] = 1;
    } else {
      $data['isCompletedLesson'] = 0;
    }

    return $data;

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
