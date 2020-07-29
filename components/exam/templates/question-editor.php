<?php global $post; ?>

<div id="question-editor">

  <div class="saber-field">
    <?php $questionTypeCode = get_post_meta( $post->ID, 'question_type', 1 ); ?>
    <label>Question Type</label>
    <select id="question_type" name="question_type">
      <option value='mc'>Multiple Choice</option>
      <option value="tf">True/False</option>
    </select>
  </div>

  <div class="saber-field">
    <label>Question Body</label>
    <textarea id="question_body" name="question_body"><?php print get_post_meta( $post->ID, 'question_body', 1 ); ?></textarea>
  </div>

  <div class="saber-field">
    <label>Question Options</label>
    <ul id="question_options_editor"></ul>
    <input type="hidden" id="question_options" name="question_options" />
  </div>

  <hr />

  <div class="saber-field">
    <label>Add to Exam</label>
    <select id="question_associate_exam" name="question_associate_exam">
      <option value='mc'>Exam 1</option>
      <option value="tf">Exam 2</option>
    </select>
  </div>

</div>

<?php

//var_dump( get_post_meta($post->ID) );

?>

<!-- options list item template -->
<template id="question-option-list-item">
  <li>
    <input class="option-id" type="hidden" />
    <input class="option-title" type="text" />
    <span class="list-item-value"></span>
    <span class="dashicons dashicons-thumbs-up"></span>
    <span class="dashicons dashicons-welcome-write-blog"></span>
    <span class="dashicons dashicons-trash"></span>
  </li>
</template>
