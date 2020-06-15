<div class="lesson-section lesson-section-conversation">

  <h2 class="conversation-title">
    <?php print $lesson->conversation->title; ?>
  </h2>

  <section class="conversation-canvas">

    <div class="conversation-canvas-header">
      <div class="speaker-left">
        <?php print $lesson->conversation->speakerA; ?>
      </div>
      <div class="speaker-right">
        <?php print $lesson->conversation->speakerB; ?>
      </div>
    </div>

    <?php
      foreach( $lesson->conversation->phrases as $phrase ):
    ?>

      <div class="speaker-text speaker-text-<?php print $phrase->speaker; ?>">
        <h3><?php print $phrase->model->phrase; ?></h3>
        <h4><?php print $phrase->model->translation; ?></h4>

        <figure>
          <!--<figcaption>Listen to audio in Spanish:</figcaption>-->
          <audio
            controls
            src="<?php print $phrase->model->audio['url']; ?>">
              Your browser does not support the
              <code>audio</code> element.
          </audio>
        </figure>
      </div>

    <?php endforeach; ?>

  </section>
</div>


<?php // var_dump( $lesson->conversation->phrases[0] ); ?>
