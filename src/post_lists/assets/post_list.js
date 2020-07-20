(function($) {

  function loadPostList() {

    console.log('loadPostList called...')

    var saberLoaderKey = $('.saber-post-list-canvas').data('saber-loader-key')
    var filterPropertyType = $('#filter_topic').val()

    console.log( window[saberLoaderKey]['postListLoadHook'] )

    // do ajax call to get new filtered posts
    data = {
      action: window[saberLoaderKey]['postListLoadHook'],
      filters: {},
      postId: window[saberLoaderKey]['postId']
    }
    $.post( window[saberLoaderKey].ajaxurl, data, function( response ) {

      response = JSON.parse( response );



      if ( response.status == 'success' ) {

        // replace content
        $('.saber-post-list-canvas').html( response.content )

      } else {

      }


      $( document ).trigger({
        type: "saber_post_list_loaded",
        loaderKey: window[saberLoaderKey],
        response: response
      });

    });

  }

  // init load
  var postListCanvas = $('.saber-post-list-canvas')
  console.log(postListCanvas)
  if( postListCanvas.length ) {
    loadPostList();
  }

  $('#filter_topic').on('change', function() {
    loadPostList();
  })

})( jQuery );
