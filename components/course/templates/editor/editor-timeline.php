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
        foreach( $course->timeline as $item ) :

          if (is_a( $item, 'Saber\Lesson\Model\Lesson')) {
            $type = 'lesson';
          }

          if (is_a( $item, 'Saber\Exam\Model\Exam')) {
            $type = 'exam';
          }

          // setup classes
          $classes = 'course-editor-timeline-item course-editor-timeline-item-' . $type;

    ?>

        <div class="<?php print $classes; ?>"
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

<!-- Study Guide File -->
<div class="saber-field">
	<?php

		$attachId = get_post_meta( $post->ID, 'course_study_guide', 1 );
		$filename = basename ( get_attached_file( $attachId ) );

	?>
	<label for="course_study_guide">Study Guide</label>
	<input type="hidden"
		id="course_study_guide"
		name="course_study_guide"
		value="<?php print $attachId; ?>"
		data-filename="<?php print $filename; ?>"
		/>
</div>
