<?php global $post; ?>

<div id="question-editor">

  <div class="saber-field">
    <label>Question Type</label> <?php print get_post_meta( $post->ID, 'question_type', 1 ); ?>
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
    <ul>
      <li>A</li>
      <li>B</li>
      <li>C</li>
    </ul>
    <textarea id="question_options" name="question_options"></textarea>
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
