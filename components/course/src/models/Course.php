<?php

namespace Saber\Course\Model;

class Course {

  public $id;
  public $title;
  public $displayOrder;
  public $intro;
  public $publicAccess = false;

  public static function load( $post ) {

    // enable passing id and loading post from id
    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new Course;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;

    $fields = get_fields($post);
    $obj->displayOrder = $fields['display_order'];
    $obj->intro = $fields['intro'];
    $obj->publicAccess = $fields['public_access'];

    return $obj;

  }

}
