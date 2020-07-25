<?php

/*
print '<pre>';
var_dump( $exam );
print '</pre>';
*/

?>

<div class="exam-editor-menu">

  <div class="exam-editor-menu-add">
    <button id="ceLessonAddButton">Add Lesson</button><button id="ceExamAddButton">Add Exam</button>
  </div>

  <div class="exam-editor-add-forms">

    <div class="exam-editor-lesson-search">
      <input
        type="text"
        placeholder="Lesson Title or ID"
        id="lessonSearchBox"
        name="lessonSearchBox"
        class="ce-search-box"
        />
      <button class="ce-search-button" id="ceLessonSearchButton">Search</button>
      <div id="ceLessonSearchResults"></div>
    </div>

    <div class="exam-editor-exam-search">
      <input
        type="text"
        placeholder="Exam Title or ID"
        id="exam-search-box"
        name="exam-search-box"
        class="ce-search-box"
      />
      <button class="ce-search-button" id="ceExamSearchButton">Search</button>
      <div id="ceExamSearchResults"></div>
    </div>

  </div>

</div>


<div class="exam-editor-timeline">
  <div class="exam-editor-timeline-grid">

    <?php
      if( count($exam->timeline) > 0):
        foreach( $exam->timeline as $item ) :

          if (is_a( $item, 'Saber\Question\Model\Question')) {
            $type = 'lesson';
          }

          // setup classes
          $classes = 'exam-editor-timeline-item exam-editor-timeline-item-' . $type;

    ?>

        <div class="<?php print $classes; ?>"
          data-id="<?php print $item->id ?>"
          data-type="question"><h4><?php print $item->title ?></h4>
          <span class="dashicons dashicons-trash"></span>
        </div>

    <?php endforeach; endif; ?>

  </div>
</div>

<textarea id="examEditorData" name="examEditorData">
  <?php print $exam->data; ?>
</textarea>
