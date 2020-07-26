<div class="exam-editor-menu">

  <div class="exam-editor-menu-add">
    <button id="question-add-button">Add Question</button>
  </div>

  <div class="editor-add-forms">

    <div id="search-form-question">
      <input
        type="text"
        placeholder="Question Title or ID"
        id="lesson-search-box"
        name="lesson-search-box"
        class="search-box"
        />
      <button class="search-button" id="question-search-button">Search</button>
      <div class="search-results">SERACH RESULTS</div>
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

<textarea id="exam-editor-data" name="exam-editor-data">
  <?php print $exam->data; ?>
</textarea>
