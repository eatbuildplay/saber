<div class="lesson-section lesson-section-word-selection">

<?php

// put all translations into array
// this array used later for the wrong selections
$allTranslations = array();
foreach( $lessonFields['words'] as $wordId ) {
  $wordPost = get_post( $wordId );
  $wordFields = get_fields( $wordId );
  $allTranslations[] = $wordFields['translation'];
}

function fetchSelectionOptions( $allTranslations, $correctTranslation ) {

  // remove correct translation from options
  if (($key = array_search($correctTranslation, $allTranslations)) !== false) {
    unset($allTranslations[$key]);
  }

  // randomize order
  shuffle( $allTranslations );

  // pick 3
  $wrongAnswers = array_slice($allTranslations, 0, 3);

  // add correct to wrong answer
  $options = $wrongAnswers;
  $options[] = $correctTranslation;

  // randomize the options
  shuffle( $options );

  // return options ordered for display
  return $options;

}

?>

  <?php

    $template = new \Saber\Template();
    $template->path = 'components/lesson/templates/';
    $template->name = 'lesson-section-header';
    $template->data = array(
      'number' => 3,
      'title' => 'Word Selection',
      'intro' => "In this exercise you'll be given the word and asked to choose it's English counterpart."
    );
    $template->render();

  ?>

  <?php

    $words = [];
    foreach( $lessonFields['words'] as $wordId ) {

      $word = new stdClass;

      $wordPost = get_post( $wordId );
      $wordFields = get_fields( $wordId );

      $word->word = $wordPost->post_title;
      $word->pronunciation = $wordFields['pronunciation'];
      $word->translation = $wordFields['translation'];
      $word->options = fetchSelectionOptions( $allTranslations, $wordFields['translation'] );

      $words[] = $word;

    }

    print '<script>';
    print 'var wordSelectionWords = ' . json_encode($words);
    print '</script>';

?>

  <div class="lesson-section-body">
    <button data-exercise="wordselection"  class="s10-start-exercise-btn word-selection-start">Start Exercise</button>
  </div>

</div>

<!-- word template -->
<template id="word-selection-template">
  <div class="word-selection">

    <img src="{image}" />
    <h2 class="word-selection-word-display">{word}</h2>
    <h3 class="word-selection-word-pronunciation">{pronunciation}</h3>
    <ul>{options}</ul>

  </div>
</template>

<!-- result template -->
<template id="word-selection-result-template">
  <div class="word-selection-result">

    <h2 class="word-selection-result-message">{message}</h2>

    <button class="s10-word-selection-next"><span>Next Word</span></button>

  </div>
</template>
