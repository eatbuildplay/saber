<?php

namespace Saber\Lesson;

class LessonPostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'lesson';
  }

}
