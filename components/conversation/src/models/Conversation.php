<?php

namespace Saber\Conversation\Model;

class Conversation {

  public $id;
  public $title;
  public $speakerA;
  public $speakerB;
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

    // speakers
    $obj->speakerA = $fields['speakers']['speaker_a'];
    $obj->speakerB = $fields['speakers']['speaker_b'];

    if( empty( $fields['phrases'] )) {
      $obj->phrases = false;
    } else {

      $phrases = [];

      foreach( $fields['phrases'] as $phraseField ) :

        $phrase = new \stdClass;
        $phrasePost = $phraseField['phrase'];
        $phrase->model = \Saber\Phrase\Model\Phrase::load( $phrasePost );

        $phrase->speaker = $phraseField['speaker'];
        $phrase->audio = $phraseField['audio'];

        $phrases[] = $phrase;

      endforeach;
      $obj->phrases = $phrases;

    }

    return $obj;

  }

}
