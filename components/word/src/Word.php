<?php

namespace Saber\Word;

class Word {

  public function __construct() {

    require_once( SABER_PATH . 'components/word/src/models/Word.php' );

    add_action('init', [$this, 'registerPostTypes']);
    add_action('init', [$this, 'registerFields']);

  }

  public function registerPostTypes() {

    require_once( SABER_PATH . 'components/word/src/cpt/WordPostType.php' );
    $pt = new WordPostType();
    $pt->register();

  }

  public function registerFields() {
    require_once( SABER_PATH . 'components/word/assets/fields.php' );
  }

}
