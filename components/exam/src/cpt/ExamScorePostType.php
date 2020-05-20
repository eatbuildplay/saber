<?php

namespace Frame\Exam;

class ExamScorePostType extends \Frame\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'exam_score';
  }

}
