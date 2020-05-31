<?php get_header(); ?>

<div class="question question-<?php print $question->id; ?>" data-question-id="<?php print $question->id; ?>">
  <h3>Question X</h3>
  <h1><?php print $question->title; ?></h1>
  <h4>Select your answer</h4>
  <ul class="selectable">
    <?php foreach( $question->options as $option ) : ?>
      <li class="question-option question-option-<?php print $option->id; ?>"
        data-question-id="<?php print $question->id; ?>"
        data-question-option-id="<?php print $option->id; ?>">
          <?php print $option->label; ?></li>
    <?php endforeach; ?>
  </ul>
</div>

<?php get_footer(); ?>
