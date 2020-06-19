<?php

namespace Saber\Course\Model;

class Course {

  public $id;
  public $title;
  public $permalink;
  public $displayOrder;
  public $level;
  public $intro;
  public $courseAccess = false;

  public static function load( $post ) {

    // enable passing id and loading post from id
    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new Course;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;
    $obj->permalink = get_permalink( $post );

    $fields = get_fields($post);
    $obj->displayOrder = $fields['display_order'];
    $obj->intro = $fields['intro'];
    $obj->courseAccess = $fields['course_access'];
    $obj->level = $fields['level'];

    return $obj;

  }

}
