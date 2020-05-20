<?php

namespace Frame\Exam;

class ExamPostType extends \Frame\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'exam';
  }

}
