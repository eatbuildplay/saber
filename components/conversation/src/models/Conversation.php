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

    if( empty( $fields['phrases'] )) {
      $obj->phrases = false;
    } else {
      $phrases = [];
      foreach( $fields['phrases'] as $phrasePost ) :
        $phrases[] = \Saber\Phrase\Model\Phrase::load( $phrasePost );
      endforeach;
      $obj->phrases = $phrases;
    }


    return $obj;

  }

}
