<?php

namespace Saber\Intel;

class TrackerCourse extends Tracker {

  public function __construct() {

    $this->initHooks();
    parent::__construct();

  }

  public function initHooks() {

    /*
     * Hook into course registration
     * Set the initial current_lesson
     */
    add_action('saber_course_registration_after',
      function( $crModel, $result ) {

        // get first lesson in course
        $crModel->course->loadLessons();
        $lesson = $crModel->course->getFirstLesson();
        $this->setCurrentLesson( $crModel->course, $lesson );

      },
      10, 2);

      /*
       * Hook into the end of exam
       * Check if score passes, if so set the lesson complete
       */
      add_action( 'saber_exam_end', function( $examId ) {

        $lessonPost = get_posts([
          'post_type'   => 'lesson',
          'numberposts' => 1,
          'meta_query'  => [
            [
              'key' => 'exam',
              'value' => $examId
            ]
          ]
        ]);

        if( !$lessonPost ) {
          return;
        }

        $lesson = \Saber\Lesson\Model\Lesson::load( $lessonPost[0] );

        $examScore = 85;

        if( $examScore >= 80 ) {
          $this->setLessonComplete( $lesson );
        }
      });

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

    $this->setObject('course', $courseId);
    $courseTracker = $this->fetch();
    return $courseTracker['current_lesson'];

  }

  public function setLessonComplete( $lesson ) {

    // store the lesson data
    $this->setObject( 'lesson', $lesson->id );
    $this->trackType  = 'complete';
    $this->trackData  = 1;
    $this->singular   = 1;
    $this->save();

    // store matching course data
    $this->setObject( 'course', $lesson->course->id );
    $this->trackType  = 'lessons_completed';
    $this->trackData  = $lesson->id;
    $this->singular   = 0;
    $this->save();

    // advance current lesson
    $course = $lesson->course;
    $course->loadLessons();
    $nextLesson = $course->getNextLesson( $lesson );
    $this->setCurrentLesson( $lesson->course, $nextLesson );

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
