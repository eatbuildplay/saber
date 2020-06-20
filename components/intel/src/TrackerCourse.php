<?php

namespace Saber\Intel;

class TrackerCourse extends Tracker {

  public function __construct() {

    $this->initHooks();
    parent::__construct();

  }

  public function initHooks() {

    add_action('saber_course_registration_after',
      function( $crModel, $result ) {
        
        // get first lesson in course
        $crModel->course->loadLessons();
        $lesson = $crModel->course->getFirstLesson();
        $this->setCurrentLesson( $crModel->course, $lesson );

      },
      10, 2);

  }

  /*
   * Record which lesson is current in the course
   */
  public function setCurrentLesson( $course, $lesson ) {

    $tracker = new \Saber\Intel\Tracker();
    $this->setObject('course', $course->id);
    $this->trackType = 'current_lesson';
    $this->trackData = $lesson->id;
    $this->singular = 1;
    $this->save();

  }

  public function getCurrentLesson() {

    $tracker = new \Saber\Intel\Tracker();
    $tracker->setObject('course', $courseId);
    $courseTracker = $tracker->fetch();
    return $courseTracker['current_lesson'];

  }

  public function setLessonComplete( $lesson, $course ) {

  }

  public function isLessonComplete( $lesson, $course ) {

  }

  /* Track course completion (for current student) */
  public function setCourseComplete( $course ) {



  }

  public function isCourseComplete() {

    return false;

  }

}
