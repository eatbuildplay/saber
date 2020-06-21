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

      $speakerA = $lesson->conversation->speakerA;
      $speakerB = $lesson->conversation->speakerB;

      $maleSpeakers = [
        'Miguel', 'Diego'
      ];

      $speakerBSexMale = 0;
      if( in_array( $speakerB, $maleSpeakers )) {
        $speakerBSexMale = true;
      }

      $speakerASexMale = 0;
      if( in_array( $speakerA, $maleSpeakers )) {
        $speakerASexMale = true;
      }

      foreach( $lesson->conversation->phrases as $phrase ):

        /*
        print '<pre>';
        var_dump( $phrase );
        print '</pre>';
        */

        if( $phrase->speaker == 'a' && $speakerASexMale ||
            $phrase->speaker == 'b' && $speakerBSexMale ) {
          $audio = $phrase->model->audioMiguel;
        } else {
          $audio = $phrase->model->audio;
        }

    ?>

      <div class="speaker-text speaker-text-<?php print $phrase->speaker; ?>">
        <h3><?php print $phrase->model->phrase; ?></h3>
        <h4><?php print $phrase->model->translation; ?></h4>

        <figure>
          <!--<figcaption>Listen to audio in Spanish:</figcaption>-->
          <audio
            controls
            src="<?php print $audio['url']; ?>">
              Your browser does not support the
              <code>audio</code> element.
          </audio>
        </figure>
      </div>

    <?php endforeach; ?>

  </section>
</div>


<?php // var_dump( $lesson->conversation->phrases[0] ); ?>
