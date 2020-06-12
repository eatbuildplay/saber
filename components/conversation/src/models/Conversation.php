<?php

namespace Saber\Conversation\Model;

class Conversation {

  public $id;
  public $title;
  public $phrases;

  public static function load( $post ) {

    // enable passing id and loading post from id
    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new Conversation;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;

    $fields = get_fields($post);
    $obj->phrases = $fields['phrases'];

    return $obj;

  }

}
