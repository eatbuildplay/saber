(function($) {

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
