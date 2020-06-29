<?php

namespace Saber\Phrase\Model;

class Phrase {

  public $id;
  public $title;
  public $phrase;
  public $translation;
  public $audio;
  public $audioMiguel;

  public function save() {

    if( $this->id > 0 ) {
      $this->update();
    } else {
      $this->id = $this->create();
      if( !$this->id ) {
        return false;
      }
    }

    $this->permalink = get_permalink( $this->id );

    update_field( 'phrase', $this->phrase, $this->id );
    update_field( 'translation', $this->translation, $this->id );

    // @TODO missing audio file updates here!

  }

  public function create() {

    $params = [
      'post_type'   => 'phrase',
      'post_title'  => $this->title,
      'post_status' => 'publish'
    ];
    $postId = wp_insert_post( $params );
    $this->id = $postId;
    return $postId;

  }

  public function update() {
    // @TODO
  }

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
    $obj->audioMiguel = $fields['audio_miguel'];

    return $obj;

  }

}
