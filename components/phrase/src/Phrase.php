<?php

namespace Saber\Phrase;

class Phrase {

  public function __construct() {

    require_once( SABER_PATH . 'components/phrase/src/models/Phrase.php' );

    add_action('init', [$this, 'registerPostTypes']);
    add_action('init', [$this, 'registerFields']);

  }

  public function registerPostTypes() {

    require_once( SABER_PATH . 'components/phrase/src/cpt/PhrasePostType.php' );
    $pt = new PhrasePostType();
    $pt->register();

  }

  public function registerFields() {
    require_once( SABER_PATH . 'components/phrase/assets/fields.php' );
  }

}
