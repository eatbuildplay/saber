<?php

namespace Saber\Phrase;

class PhrasePostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'phrase';
  }

}
