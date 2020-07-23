<div class="course-editor-menu">

  <div class="course-editor-menu-add">
    <button id="ceLessonAddButton">Add Lesson</button><button id="ceExamAddButton">Add Exam</button>
  </div>

  <div class="course-editor-add-lesson">

    <div class="course-editor-lesson-search">
      <input type="text" placeholder="Lesson Title or ID" id="lessonSearchBox" name="lessonSearchBox" />
      <button id="ceLessonSearchButton">Search</button>
      <div id="ceLessonSearchResults"></div>
    </div>

    <div class="course-editor-exam-search">
      <input type="text" placeholder="Exam Title or ID" id="exam-search-box" name="exam-search-box" />
      <button id="ceExamSearchButton">Search</button>
    </div>

  </div>

</div>


<div class="course-editor-timeline">
  <div class="course-editor-timeline-grid"></div>
</div>

<?php

global $post;
$key = 'saber_course_timeline_data';
$value = get_post_meta( $post->ID, $key, true );

?>

<textarea id="ceEditorData" name="ceEditorData">
  <?php print $value; ?>
</textarea>
