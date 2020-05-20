(function($) {

  function loadPostList() {

    console.log('loadPostList called...')

    var frameLoaderKey = $('.frame-post-list-canvas').data('frame-loader-key')
    var filterPropertyType = $('#filter_topic').val()

    console.log( window[frameLoaderKey]['postListLoadHook'] )

    // do ajax call to get new filtered posts
    data = {
      action: window[frameLoaderKey]['postListLoadHook'],
      filters: {},
      postId: window[frameLoaderKey]['postId']
    }
    $.post( window[frameLoaderKey].ajaxurl, data, function( response ) {

      response = JSON.parse( response )

      if ( response.status == 'success' ) {

        // replace content
        $('.frame-post-list-canvas').html( response.content )

      } else {

      }
    });

  }

  // init load
  var postListCanvas = $('.frame-post-list-canvas')
  console.log(postListCanvas)
  if( postListCanvas.length ) {
    loadPostList();
  }

  $('#filter_topic').on('change', function() {
    loadPostList();
  })

})( jQuery );
