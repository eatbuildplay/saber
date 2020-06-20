<?php

namespace Saber\Intel;

class TrackerCourse extends Tracker {

  /*
   * Record which lesson is current in the course
   */
  public function setCurrentLesson( $course, $lesson ) {

    $tracker = new \Saber\Intel\Tracker();
    $this->setObject('course', $course->id);
    $this->trackType = 'current_lesson';
    $this->trackData = $lesson->id;
    $this->singular = 1;
    $tracker->save();

  }

  public function getCurrentLesson() {

    $tracker = new \Saber\Intel\Tracker();
    $tracker->setObject('course', $courseId);
    $courseTracker = $tracker->fetch();

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
