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

        <figure>
          <!--<figcaption>Listen to audio in Spanish:</figcaption>-->
          <audio
            controls
            src="<?php print $phrase->model->audio['url']; ?>">
              Your browser does not support the
              <code>audio</code> element.
          </audio>
        </figure>


        <hr />

      <?php
        endforeach;

      ?>

    </div>

    <div class="conversation-right">

      <?php print $lesson->conversation->speakerB; ?>

    </div>

  </section>

</div>


<?php

var_dump( $lesson->conversation->phrases[0] ); ?>
