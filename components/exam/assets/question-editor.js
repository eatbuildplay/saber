(function($) {

  var QuestionEditor = {

    question: questionEditor.question,

    data: {
      options: questionEditor.question.options
    },

    init: function() {

      /* setup question options list */
      $('#question_options_editor').sortable({
        stop: function( event, ui ) {
          QuestionEditor.updateData();
        }
      });

      var template = $('#question-option-list-item');

      if( QuestionEditor.data.options.length == 0 ) {

        // add default options
        $( template.html() ).appendTo('#question_options_editor')
          .find('.list-item-value').text('A')
          .parent().find('input.option-id').val('0')
          .parent().find('input.option-title').val('A');

        $( template.html() ).appendTo('#question_options_editor')
          .find('.list-item-value').text('B')
          .parent().find('input.option-id').val('0')
          .parent().find('input.option-title').val('B');

        $( template.html() ).appendTo('#question_options_editor')
          .find('.list-item-value').text('C')
          .parent().find('input.option-id').val('0')
          .parent().find('input.option-title').val('C');

          $( template.html() ).appendTo('#question_options_editor')
            .find('.list-item-value').text('D')
            .parent().find('input.option-id').val('0')
            .parent().find('input.option-title').val('D');

      } else {

        // existing options
        QuestionEditor.data.options.forEach( function( option ) {
          $( template.html() ).appendTo('#question_options_editor')
            .find('.list-item-value').text( option.label )
            .parent().find('input.option-id').val( option.id )
            .parent().find('input.option-title').val( option.label );
        });

        $('#question_options').val( JSON.stringify(QuestionEditor.question.options));

      }

      // start edits
      $(document).on('click', '#question_options_editor .dashicons-welcome-write-blog', function() {

        var item = $(this).parent();

        item.find('.dashicons-welcome-write-blog').hide();
        item.find('.dashicons-trash').hide();
        item.find('.list-item-value').hide();

        item.find('input.option-title').show();
        item.find('.dashicons-thumbs-up').show();

      });

      // save edits
      $(document).on('click', '#question_options_editor .dashicons-thumbs-up', function() {

        var item = $(this).parent();
        var value = item.find('input.option-title').val();

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
          id: itemEl.find('input.option-id').val(),
          title: itemEl.find('input.option-title').val(),
          label: itemEl.find('input.option-title').val(),
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
