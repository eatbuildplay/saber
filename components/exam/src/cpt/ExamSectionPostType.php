<?php

namespace Saber\Exam;

class ExamSectionPostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'exam_section';
  }

}
