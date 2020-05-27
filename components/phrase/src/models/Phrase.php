<?php

namespace Saber\Phrase\Model;

class Phrase {

  public $id;
  public $title;

  public static function load( $post ) {

    // enable passing id and loading post from id
    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new Phrase;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;

    $fields = get_fields($post);

    return $obj;

  }

}
