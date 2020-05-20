<div class="saber-property-filters">
  <div class="saber-property-filter">
    <label>Filter by Course</label>
    <select id="filter_course">
      <option value='6'>Course 1</option>
      <option value='6'>Course 2</option>
    </select>
  </div>
</div>

<script>

(function($) {

  $('#filter_course').on('change', function() {
    console.log('filter selected')

    // do ajax call to get new filtered posts
    data = {
      action: 'saber_property_list_load'
    }
    $.post( ElementorProFrontendConfig.ajaxurl, data, function( response ) {
      if ( response.status == 'success' ) {

      } else {

      }
    });

  })

})( jQuery );

</script>
