<?php

namespace Frame\Exam;

class ExamSectionPostType extends \Frame\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'exam_section';
  }

}
