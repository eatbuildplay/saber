(function($) {

  var QuestionEditor = {

    question: saberData.question,

    data: {
      options: saberData.question.options
    },

    init: function() {

      // setup selects
      $('#question_type').val( QuestionEditor.question.questionType );

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
          .closest('li').find('input.option-id').val('0')
          .closest('li').find('input.option-title').val('A')
          .closest('li').find('input.option-correct').val( 0 );

        $( template.html() ).appendTo('#question_options_editor')
          .find('.list-item-value').text('B')
          .closest('li').find('input.option-id').val('0')
          .closest('li').find('input.option-title').val('B')
          .closest('li').find('input.option-correct').val( 0 );

        $( template.html() ).appendTo('#question_options_editor')
          .find('.list-item-value').text('C')
          .closest('li').find('input.option-id').val('0')
          .closest('li').find('input.option-title').val('C')
          .closest('li').find('input.option-correct').val( 0 );

          $( template.html() ).appendTo('#question_options_editor')
            .find('.list-item-value').text('D')
            .closest('li').find('input.option-id').val('0')
            .closest('li').find('input.option-title').val('D')
            .closest('li').find('input.option-correct').val( 0 );

      } else {

        // existing options
        QuestionEditor.data.options.forEach( function( option ) {
          var item = $( template.html() )
          item.appendTo('#question_options_editor')
            .find('.list-item-value').text( option.label )
            .closest('li').find('input.option-id').val( option.id )
            .closest('li').find('input.option-title').val( option.label )
            .closest('li').find('input.option-correct').val( option.correct );
          if( option.correct == 1 ) {
            console.log( item )
            item.find('.dashicons-dismiss').hide();
            item.find('.dashicons-yes-alt').show();
          }
        });

        QuestionEditor.updateData();

      }

      // add new option
      $('#question_option_add').on('click', function(e) {
        e.preventDefault();
        $( template.html() ).appendTo('#question_options_editor')
          .find('.list-item-value').text( 'New Option' )
          .closest('li').find('input.option-id').val( 0 )
          .closest('li').find('input.option-title').val( 'New Option' );
      });

      // start edits
      $(document).on('click', '#question_options_editor .dashicons-welcome-write-blog', function() {

        var item = $(this).closest('li');

        item.find('.editor-mode-display').hide();
        item.find('.editor-mode-edit').show();

      });

      // save edits
      $(document).on('click', '#question_options_editor .dashicons-thumbs-up', function() {

        var item = $(this).closest('li');
        var value = item.find('input.option-title').val();
        item.find('.list-item-value').text(value);
        item.find('.editor-mode-display').show();
        item.find('.editor-mode-edit').hide();
        QuestionEditor.updateData();

      });

      // delete option
      $(document).on('click', '#question_options_editor .dashicons-trash', function() {
        $(this).closest('li').remove();
        QuestionEditor.updateData();
      });

      // handle correct settings
      $(document).on('click', '.dashicons-dismiss', function() {
        $(this).hide();
        var item = $(this).closest('li');
        item.find('.dashicons-yes-alt').show();
        item.find('.option-correct').val(1);
        QuestionEditor.updateData();
      });

      $(document).on('click', '.dashicons-yes-alt', function() {
        $(this).hide();
        var item = $(this).closest('li');
        item.find('.dashicons-dismiss').show();
        item.find('.option-correct').val(0);
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
          correct: itemEl.find('input.option-correct').val(),
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
