(function($) {

  var wordscan = {

    wordIndex: 0,

    init: function() {

      $('.wordscan-start').on('click', wordscan.start)
      $( document ).on('click', '.wordscan-controls .s10-rating', wordscan.rating)
      $( document ).on('click', '.wordscan-controls .s10-restart', wordscan.restart)
      $( document ).on('click', '.wordscan-controls .s10-next-lesson', wordscan.nextExercise)

    },

    nextExercise: function() {

      $('.lesson-single-tabs li').removeClass('active')
      $('.lesson-single-tabs li.exercise-flashcards').addClass('active')
      $('.lesson-section').hide()
      $('.lesson-section-flashcards').show()

    },

    rating: function() {

      // get word if any left
      var newWordIndex = wordscan.wordIndex +1
      var word = wordscanWords[ newWordIndex ]

      if( word == undefined ) {
        wordscan.finish()
        return;
      }

      // stash current wordIndex
      wordscan.wordIndex = wordscan.wordIndex +1

      // load image file from url
      if( word.image ) {
        wordscan.imageLoad( word.image );
      }

      // get template
      var template = $('#wordscan-word-template').html()

      // replace tags with content data
      template = template.replace('{word}', word.word)
      template = template.replace('{translation}', word.translation)
      template = template.replace('{pronunciation}', word.pronunciation)
      template = template.replace('{image}', word.image);

      // place content
      $('.lesson-section-wordscan .lesson-section-body').html( template )

      // get the word as an element so we can make changes
      var $wordEl = $('.wordscan-word');

      // image handling
      if( !word.image ) {
        // remove missing image
        $wordEl.find('img').remove()
      }

    },

    imageLoad: function( url ) {
      var img = new Image();
      img.src = url;
    },

    finish: function() {
      var template = $('#wordscan-finish').html()
      $('.lesson-section-wordscan .lesson-section-body').html( template )
    },

    restart: function() {
      wordscan.wordIndex = 0;
      wordscan.start();
    },

    start: function() {

      // hide start
      $('.wordscan-start').hide()
      $('.lesson-section-wordscan .lesson-section-header').hide()
      wordscan.rating()
    }

  }
  wordscan.init()
  /* end wordscan class */

  /*
   *
   * Flashcards
   *
   */
  var flashcard = {

    wordIndex: 0,

    init: function() {

      $('.flashcard-start').on('click', flashcard.start)
      $( document ).on('click', '.flashcard-up', flashcard.flip)
      $( document ).on('click', '.flashcard-reset', flashcard.reset)
      $( document ).on('click', '.flashcard-controls .s10-rating', flashcard.rating);
      $( document ).on('click', '.flashcard-controls .s10-restart', flashcard.restart);
      $( document ).on('click', '.flashcard-controls .s10-next-lesson', flashcard.nextExercise)


    },

    nextExercise: function() {

      $('.lesson-single-tabs li').removeClass('active')
      $('.lesson-single-tabs li.exercise-word-selection').addClass('active')
      $('.lesson-section').hide()
      $('.lesson-section-word-selection').show()

    },

    restart: function() {
      flashcard.wordIndex = 0;
      flashcard.start();
    },

    start: function() {

      // hide start
      $('.flashcard-start').hide()
      $('.lesson-section-flashcards .lesson-section-header').hide()

      var header = $('.lesson-section-flashcards .lesson-section-header')
      flashcard.rating()

    },

    rating: function() {

      // get word if any left
      var newWordIndex = flashcard.wordIndex +1
      var word = flashcardWords[ newWordIndex ]

      if( word == undefined ) {
        flashcard.finish()
        return;
      }

      // stash current wordIndex
      flashcard.wordIndex = flashcard.wordIndex +1

      // load image file from url
      /*
      if( word.image ) {
        flashcard.imageLoad( word.image );
      }
      */

      // get template
      var template = $('#flashcard-template').html()

      // replace tags with content data
      //template = template.replace('{word}', word.word)
      template = template.split('{word}').join(word.word)
      template = template.split('{translation}').join(word.translation)
      template = template.split('{pronunciation}').join(word.pronunciation)
      //template = template.replace('{image}', word.image);

      // place content
      $('.lesson-section-flashcards .lesson-section-body').html( template )

      // get the word as an element so we can make changes
      var $wordEl = $('.flashcard');

      // image handling
      if( !word.image ) {
        // remove missing image
        $wordEl.find('img').remove()
      }

    },

    flip: function() {

      $(this).siblings('.flashcard-down').addClass('flashcard-active')
      $(this).removeClass('flashcard-active')

    },

    reset: function() {

      $('.flashcard-down').removeClass('flashcard-active')
      $('.flashcard-up').addClass('flashcard-active')

    },

    finish: function() {
      var template = $('#flashcard-finish').html()
      $('.lesson-section-flashcards .lesson-section-body').html( template )
    }

  }
  flashcard.init();


  /*
   *
   * Word Selection
   *
   */
  var wordSelection = {

    wordIndex: 0,

    init: function() {

      $('.word-selection-start').on('click', wordSelection.start);
      $( document ).on('click', '.word-selection-controls .s10-rating', wordSelection.rating);
      $( document ).on('click', '.word-selection-controls .s10-restart', wordSelection.restart);
      $( document ).on('click', '.word-selection-controls .s10-next-lesson', wordSelection.nextExercise);
      $( document ).on('click', '.word-selection li.selectable', wordSelection.select);
      $( document ).on('click', '.s10-word-selection-next', wordSelection.rating) ;

    },

    select: function() {

      $(this).addClass('selected')

      // remove click events or lock
      $('.word-selection ul li').removeClass('selectable');

      // check if it's correct
      var word = wordSelectionWords[ wordSelection.wordIndex ];
      var wordSelected = $(this).data('word');
      var isCorrect = false;
      if( word.translation == wordSelected ) {
        isCorrect = true;
      }

      // show results
      if( isCorrect ) {
        var message = '<i class="fas fa-thumbs-up"></i> Yes, you are correct.';
      } else {
        var message = '<i class="fas fa-thumbs-down"></i> No that answer is incorrect.';
      }

      var template = $('#word-selection-result-template').html();
      template = template.replace('{message}', message);
      $('.word-selection').append( template );

    },

    nextExercise: function() {

      $('.lesson-single-tabs li').removeClass('active')
      $('.lesson-single-tabs li.exercise-word-selection').addClass('active')
      $('.lesson-section').hide()
      $('.lesson-section-word-selection').show()

    },

    restart: function() {
      wordSelection.wordIndex = 0;
      wordSelection.start();
    },

    start: function() {

      // hide start
      $('.word-selection-start').hide()
      $('.lesson-section-word-selection .lesson-section-header').hide()

      var header = $('.lesson-section-word-selection .lesson-section-header')
      wordSelection.rating()

    },

    rating: function() {

      // get word if any left
      var newWordIndex = wordSelection.wordIndex +1
      var word = wordSelectionWords[ newWordIndex ]

      console.log( word )

      if( word == undefined ) {
        wordSelection.finish()
        return;
      }

      // stash current wordIndex
      wordSelection.wordIndex = wordSelection.wordIndex +1

      // get template
      var template = $('#word-selection-template').html()

      // replace tags with content data
      //template = template.replace('{word}', word.word)
      template = template.split('{word}').join(word.word)
      template = template.split('{translation}').join(word.translation)
      template = template.split('{pronunciation}').join(word.pronunciation)
      //template = template.replace('{image}', word.image);

      var options = '';
      word.options.forEach( function( option, index ) {
        options += '<li class="selectable" data-word="' + option + '">';
        options += option;
        options += '</li>';
      })
      template = template.replace('{options}', options);

      // place content
      $('.lesson-section-word-selection .lesson-section-body').html( template )

      // get the word as an element so we can make changes
      var $wordEl = $('.word-selection');

      // image handling
      if( !word.image ) {
        // remove missing image
        $wordEl.find('img').remove()
      }

    },

    finish: function() {
      var template = $('#word-selection-finish').html()
      $('.lesson-section-word-selection .lesson-section-body').html( template )
    }

  }
  wordSelection.init();

  /*

  /* Loose Functions */

  // lesson single tabs
  $('.lesson-single-tabs li').on('click', function() {

    $('.lesson-single-tabs li').removeClass('active')
    $(this).addClass('active')

    var sectionName = $(this).data('section')

    $('.lesson-section').hide()
    $('.lesson-section-' + sectionName).show()

  })

  // return to top button
  $('.s10-to-top').on('click', function() {
    $('html, body').animate({ scrollTop: 0 }, 'fast');
  })

  // next lesson button
  $('.s10-next-lesson').on('click', function() {
    window.location.href = saberLesson.nextLesson.url;
  })

  // record start exercise
  $('.s10-start-exercise-btn').on('click', function() {

    let exercise = $(this).data('exercise');

    data = {
      action: 'saber_exercise_view',
      lessonId: saberLesson.lesson.id,
      exercise: exercise
    }
    $.post( saber_post_list_load.ajaxurl, data, function( response ) {

      response = JSON.parse(response);
      console.log( response );

    });
  })

})( jQuery );
