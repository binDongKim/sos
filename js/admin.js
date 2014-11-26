( function( $ ) {
  'use strict';
  $(document).ready(function () {
  });
  $(document).on('click', '[data-action]', function (ev) {
    // $(this) = $('['data-action]')
    switch ($(this).data('action')) {
      case 'add-team':
        var $div         = $(this).parent();
        var $teamListDiv = $div.find('div');
        var teamName     = $div.find('select option:selected').text();
        var teamId       = $div.find('select option:selected').val();

        var flag = false;
        $($teamListDiv.find('input[type=hidden]')).each(function () {
          if ( teamId == $(this).val() ) {
            flag = true;
            return false;
          }
        });
        if( ! flag ) {
          var $nameInput = '<input type="text" name="my-team[name][]" value="' + teamName + '" class="form-control input-team-name" readonly="readonly">';
          var $removeBtn = '<button type="button" data-action="remove-team" class="remove-team btn btn-default btn-xs pull-right"><i class="fa fa-minus"></i></button>';
          var $idInput   = '<input type="hidden" name="my-team[id][]" value="' + teamId   + '" class="form-control">';

          $teamListDiv.append('<article>' + $nameInput + $removeBtn + $idInput + '<article>');
        }
        break;
      case 'remove-team':
        $(ev.target).parents('article').remove();
        break;
    }
  });
} )( jQuery );
