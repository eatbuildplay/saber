(function($) {

  var QuestionEditor = {

    data: {
      options: []
    },

    init: function() {

      /* setup question options list */
      $('#question_options_editor').sortable();

      var template = $('#question-option-list-item');

      $( template.html() ).appendTo('#question_options_editor')
        .find('.list-item-value').text('A')
        .parent().find('input').val('A');
      $( template.html() ).appendTo('#question_options_editor')
        .find('.list-item-value').text('B')
        .parent().find('input').val('B');
      $( template.html() ).appendTo('#question_options_editor')
        .find('.list-item-value').text('C')
        .parent().find('input').val('C');
        $( template.html() ).appendTo('#question_options_editor')
          .find('.list-item-value').text('D')
          .parent().find('input').val('D');

      // start edits
      $(document).on('click', '#question_options_editor .dashicons-welcome-write-blog', function() {

        var item = $(this).parent();

        item.find('.dashicons-welcome-write-blog').hide();
        item.find('.dashicons-trash').hide();
        item.find('.list-item-value').hide();

        item.find('input').show();
        item.find('.dashicons-thumbs-up').show();

      });

      // save edits
      $(document).on('click', '#question_options_editor .dashicons-thumbs-up', function() {

        var item = $(this).parent();
        var value = item.find('input').val();

        item.find('input').hide();
        item.find('.dashicons-thumbs-up').hide();

        item.find('.dashicons-welcome-write-blog').show();
        item.find('.dashicons-trash').show();
        item.find('.list-item-value').text(value).show();

        QuestionEditor.updateData();

      });

      // delete option
      $(document).on('click', '#question_options_editor .dashicons-trash', function() {

        $(this).parent().remove();

        QuestionEditor.updateData();

      });

    },

    updateData: function() {

      QuestionEditor.data.options = [];

      $('#question_options_editor li').each( function( index, item ) {

        var itemEl = $(item);
        var option = {
          title: itemEl.find('.list-item-value').text(),
          correct: 0
        };
        QuestionEditor.data.options.push( option );

      });

      var json = JSON.stringify( QuestionEditor.data.options );
      $('#question_options').val( json );

    }

  } // end QuestionEditor


  // init
  QuestionEditor.init();

})( jQuery );
