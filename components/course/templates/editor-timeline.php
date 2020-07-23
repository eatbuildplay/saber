<div class="course-editor-menu">

  <div class="course-editor-menu-add">
    <button id="ceLessonAddButton">Add Lesson</button><button id="ceExamAddButton">Add Exam</button>
  </div>

  <div class="course-editor-add-forms">

    <div class="course-editor-lesson-search">
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

    <div class="course-editor-exam-search">
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


<div class="course-editor-timeline">
  <div class="course-editor-timeline-grid">

    <?php
      if( count($course->timeline) > 0):
        foreach( $course->timeline as $item ) : ?>

        <div class="course-editor-timeline-item"
          data-id="<?php print $item->id ?>"
          data-type="lesson"><h4><?php print $item->title ?></h4>
          <span class="dashicons dashicons-trash"></span>
        </div>

    <?php endforeach; endif; ?>

  </div>
</div>

<textarea id="ceEditorData" name="ceEditorData">
  <?php print $course->data; ?>
</textarea>
