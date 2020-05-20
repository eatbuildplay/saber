<div class="lesson-section lesson-section-flashcards">

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
    print 'var flashcardWords = ' . json_encode($words);
    print '</script>';

  ?>

  <?php

    $template = new \Saber\Template();
    $template->path = 'components/lesson/templates/';
    $template->name = 'lesson-section-header';
    $template->data = array(
      'number' => 2,
      'title' => 'FlashCards',
      'intro' => 'In this section you will learn to associate the Spanish word with it\'s English counterpart. If possible, say the word out loud during this exercise to practice the pronunciation.'
    );
    $template->render();

  ?>

  <div class="lesson-section-body">
    <button class="s10-start-exercise-btn flashcard-start">Show me the cards!</button>
  </div>




</div>


<!-- word template -->
<template id="flashcard-template">
  <div class="flashcard">

    <div class="flashcard-up flashcard-active">
      <h2 class="flashcard-word-display">{word}</h2>
      <h3 class="flashcard-word-pronunciation">{pronunciation}</h3>
    </div>

    <div class="flashcard-down">

      <button class="flashcard-reset">Reset Flashcard</button>
      <h2 class="flashcard-word-translation">{word} = {translation}</h2>
      <h3 class="flashcard-word-pronunciation">{pronunciation}</h3>

      <div class="flashcard-controls">
        <h3>Did you know this word?</h3>
        <button class="s10-rating s10-rating-flashcard"><i class="fas fa-thumbs-down fa-2x"></i> <br /><span>Weak</span></button><button class="s10-rating s10-rating-flashcard"><i class="fas fa-thumbs-up fa-2x"></i> <br /><span>Strong</span></button>
      </div>

    </div>
  </div>
</template>
