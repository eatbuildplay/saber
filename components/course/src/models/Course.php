<?php

namespace Saber\Course\Model;

class Course {

  public $id;
  public $title;
  public $permalink;
  public $data; // json loading data
  public $timeline; // timeline objects
  public $studyGuide;

  public static function load( $post ) {

    // enable passing id and loading post from id
    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new Course;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;
    $obj->permalink = get_permalink( $post );

    // course editor data
    $key = 'saber_course_timeline_data';
    $obj->data = get_post_meta( $post->ID, $key, true );

    // form timeline objects
    $obj->timeline = [];
    $data = json_decode( $obj->data );

    foreach( $data->timeline as $item ) {
      if( $item->type == 'lesson' ) {
        $obj->timeline[] = \Saber\Lesson\Model\Lesson::load( $item->id );
      }
      if( $item->type == 'exam' ) {
        $obj->timeline[] = \Saber\Exam\Model\Exam::load( $item->id );
      }
    }

    // study guide
    $attachmentId = get_post_meta( $post->ID, 'course_study_guide', 1 );
    if( $attachmentId ) {
      $obj->studyGuide = new \stdClass;
      $obj->studyGuide->id = $attachmentId;
      $obj->studyGuide->url = wp_get_attachment_url( $attachmentId );
      $obj->studyGuide->filename = basename ( get_attached_file( $attachmentId ) );
    } else {
      $obj->studyGuide = false;
    }

    return $obj;

  }

  public function loadLessons() {

    $lessonPosts = get_posts([
      'post_type' => 'lesson',
      'numberposts' => -1,
      'meta_query' => [
        [
          'key'     => 'course',
          'value'   => $this->id,
          'compare' => '='
        ]
      ],
      'orderby'   => 'meta_value_num',
      'order'     => 'ASC',
      'meta_key'  => 'display_order'
    ]);

    if(empty( $lessonPosts )) {
      $this->lessons = false;
    }

    $lessons = [];
    foreach( $lessonPosts as $lessonPost ) {
      $lessons[] = \Saber\Lesson\Model\Lesson::load( $lessonPost );
    }

    $this->lessons = $lessons;

  }

  public function getFirstLesson() {

    if( !empty($this->lessons)) {
      return $this->lessons[0];
    }

    return 0;

  }

  public function getNextLesson( $currentLesson ) {

    $currentLessonIndex = 0;
    foreach( $this->lessons as $index => $lesson ) {
      if( $lesson->id == $currentLesson->id ) {
        $currentLessonIndex = $index;
        break;
      }
    }

    $nextLessonIndex = $currentLessonIndex +1;
    return $this->lessons[ $nextLessonIndex ];

  }

}
