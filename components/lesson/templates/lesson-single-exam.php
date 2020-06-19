<div class="lesson-section lesson-section-exam">
  
  <h2>Lesson Test</h2>
  <h4>Are you ready to be tested?</h4>
  <p>Scores from the lesson test are stored, achieve a minimum passing grade to unlock the next lesson.</p>
  <?php print $lesson->exam->title; ?>

  <?php
    $ess = new \Saber\Exam\ExamSingleShortcode();
    print $ess->doShortcode( ['id' => $lesson->exam->id] );
  ?>

</div>
