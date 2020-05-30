<?php

$correct = 0;
$points = 0;
foreach( $examScore->questions as $qs ) {
  $correct += $qs->correct;
  $points += $qs->points;
}
$questionCount = count($examScore->questions);
if( $points ) {
  $scorePercent = round(($points / $questionCount) * 100);
} else {
  $scorePercent = 0;
}

get_header();

?>

<div class="exam-score-single-wrap">
  <div class="exam-score-single">

    <h2>Exam Result - <?php print $examScore->exam->title; ?></h2>

    <header>

      <div class="header-col-1">
        <h2><?php print $scorePercent; ?>%</h2>
        <h6>Total Score</h6>
      </div>
      <div class="header-col-2">
        <h4>Taken At <?php print $examScore->start; ?></h4>
        <h4>Exam ID: <?php print $examScore->exam->id; ?></h4>
        <h4>User <?php print $examScore->user['display_name']; ?></h4>
      </div>
    </header>

    <h3>Question Summary</h3>

    <?php
      if(!empty($examScore->questions)):
        foreach( $examScore->questions as $qa ):
    ?>

      <h3><?php print $qa->title; ?></h3>
      <h5>Points Awarded: <?php print $qa->points; ?></h5>
      <h5>Correct: <?php print $qa->correct; ?></h5>

    <?php endforeach; endif; ?>

  </div>
</div>

<?php

print '<pre>';
// var_dump( $examScore );
print '</pre>';

?>

<?php get_footer(); ?>
