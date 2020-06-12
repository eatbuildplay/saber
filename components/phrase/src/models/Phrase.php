<?php

namespace Saber\Phrase\Model;

class Phrase {

  public $id;
  public $title;
  public $phrase;
  public $translation;
  public $audio;

  public static function load( $post ) {

    // enable passing id and loading post from id
    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new Phrase;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;

    $fields = get_fields($post);

    $obj->phrase = $fields['phrase'];
    $obj->translation = $fields['translation'];
    $obj->audio = $fields['audio_file'];

    return $obj;

  }

}
