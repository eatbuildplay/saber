<div class="lesson-section lesson-section-wordscan">

<?php

  $words = array();
  foreach( $lessonFields['words'] as $wordId ) {

    $wordPost = get_post( $wordId );
    $wordFields = get_fields( $wordId );

    $word = new stdClass();
    $word->word = $wordPost->post_title;
    $word->translation = $wordFields['translation'];
    $word->pronunciation = $wordFields['pronunciation'];
    $word->image = $wordFields['image'];

    $words[] = $word;

  }

  print '<script>';
  print 'var wordscanWords = ' . json_encode($words);
  print '</script>';

?>

<?php

  $template = new \Saber\Template();
  $template->path = 'components/lesson/templates/';
  $template->name = 'lesson-section-header';
  $template->data = array(
    'number' => 1,
    'title' => 'WordScan',
    'intro' => 'In this lesson you will to learn to read, speak and hear 10 words. Scan over the words briefly now, taking note of the translation and the pronunciation.'
  );
  $template->render();

?>

  <div class="lesson-section-body">
    <button class="s10-start-exercise-btn wordscan-start">Start Exercise</button>
  </div>

</div>

<!-- word template -->
<template id="wordscan-word-template">
  <div class="wordscan-word">

    <img src="{image}" />
    <h2 class="wordscan-word-display">{word} = {translation}</h2>
    <h3 class="wordscan-word-pronunciation">{pronunciation}</h3>

    <div class="wordscan-controls">
      <h3>Rate your knowledge of this word</h3>
      <button class="s10-rating s10-rating-flashcard"><i class="fas fa-thumbs-down fa-1x"></i> <span>Weak</span></button><button class="s10-rating s10-rating-flashcard"><i class="fas fa-balance-scale fa-1x"></i> <span>Medium</span></button><button class="s10-rating s10-rating-flashcard"><i class="fas fa-thumbs-up fa-1x"></i> <span>Strong</span></button>
    </div>
  </div>
</template>
