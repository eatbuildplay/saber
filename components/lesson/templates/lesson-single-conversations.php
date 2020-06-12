<div class="lesson-section lesson-section-conversation">

  <h2 class="conversation-title">
    <?php print $lesson->conversation->title; ?>
  </h2>

  <section class="conversation-canvas">

    <div class="conversation-left">

      <?php print $lesson->conversation->speakerA; ?>

      <?php

        foreach( $lesson->conversation->phrases as $phrase ):
      ?>

        <h2><?php print $phrase->model->phrase; ?></h2>
        <h3><?php print $phrase->model->translation; ?></h2>
        <hr />

      <?php
        endforeach;

      ?>

    </div>

    <div class="conversation-right">

      <?php print $lesson->conversation->speakerB; ?>

    </div>

  </section>

  <?php // var_dump( $lesson->conversation->phrases[0] ); ?>

</div>
