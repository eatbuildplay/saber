<?php

namespace Saber\Lesson\Model;

class Lesson {

  public $id;
  public $title;
  public $permalink;
  public $type = 'lesson';
  public $video;
  public $overview;
  public $duration;

  public function load( $post ) {

    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new Lesson;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;
    $obj->permalink = get_permalink( $post->ID );

    $videoAttachmentId = get_post_meta( $obj->id, 'lesson_video', 1 );

    if( $videoAttachmentId ) {
      $obj->video = new \stdClass;
      $obj->video->url = wp_get_attachment_url( $videoAttachmentId );
    }

    $obj->overview = get_post_meta( $obj->id, 'lesson_overview', 1 );
    $obj->duration = get_post_meta( $obj->id, 'lesson_duration', 1 );

    return $obj;

  }

}
