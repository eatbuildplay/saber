<div class="lesson-single-tabs">
  <ul>
    <li class="exercise-wordscan active" data-section="wordscan">1. WordScan</li><li class="exercise-flashcards" data-section="flashcards">2. FlashCards</li><li class="exercise-word-selection" data-section="word-selection">3. Word Selection</li>
    <?php if( $lesson->conversation ): ?><li class="exercise-conversation" data-section="conversation">4. Conversation</li><?php endif; ?>
    <?php if( $lesson->exam ): ?><li class="exercise-exam" data-section="exam">5. Test</li><?php endif; ?>
  </ul></div>
