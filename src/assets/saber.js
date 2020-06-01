(function($) {

  var events = [
    {
      date: 'Q1 - 2018',
      content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
    },
    {
      date: 'Q2 - 2018',
      content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
    },
    {
      date: 'Q3 - 2018',
      content: 'Lorem ipsum dolor sit amet<small>Consectetur adipisicing elit</small>'
    }
  ];

  $('.timeline').roadmap(events, {
    eventsPerSlide: 6,
    slide: 1,
    prevArrow: '<i class="material-icons">keyboard_arrow_left</i>',
    nextArrow: '<i class="material-icons">keyboard_arrow_right</i>',
    onBuild: function() {
      console.log('onBuild event')
    }
  });

})( jQuery );
