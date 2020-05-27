<?php

namespace Saber\Word\Model;

class Word {

  public $id;
  public $title;

  public static function load( $post ) {

    // enable passing id and loading post from id
    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new Word;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;

    $fields = get_fields($post);

    return $obj;

  }

}
