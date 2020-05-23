<?php get_header(); ?>

<div>

  <h5><?php print $examScore->id; ?></h5>
  <h5><?php print $examScore->title; ?></h5>

  <h5>
    Exam ID: <?php print $examScore->exam->id; ?>
    <br /><?php print $examScore->exam->title; ?>
  </h5>

  <h5>User <?php print $examScore->user['display_name']; ?></h5>

  <h5>Started Exam At: <?php print $examScore->start; ?></h5>

  <?php foreach( $examScore->questions as $qa ): ?>

    <h3><?php print $qa->title; ?></h3>
    <h5>Points Awarded: <?php print $qa->points; ?></h5>
    <h5>Correct: <?php print $qa->correct; ?></h5>


  <?php endforeach; ?>

</div>

<?php

// var_dump( $examScore );

?>

<?php get_footer(); ?>
