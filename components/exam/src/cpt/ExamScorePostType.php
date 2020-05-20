<?php

namespace Saber\Exam;

class ExamScorePostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'exam_score';
  }

}
