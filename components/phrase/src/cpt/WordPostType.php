<?php

namespace Saber\Word;

class WordPostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'word';
  }

}
