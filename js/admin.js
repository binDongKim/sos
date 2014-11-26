( function( $ ) {
  'use strict';
  $(document).ready(function () {
  });
  $(document).on('click', '[data-action]', function (ev) {
    // $(this) = $('['data-action]')
    switch ($(this).data('action')) {
      case 'add-team':
        var $div     = $(this).parent();
        var $ul      = $div.find('ul');
        var teamName = $div.find('select option:selected').text();
        var teamId   = $div.find('select option:selected').val();

        var flag = false;
        $($ul.find('li')).each(function () {
          if ( teamId == $(this).data('teamId') ) {
            flag = true;
            return false;
          }
        });
        if( ! flag ) {
          var $li = '<li class="team-group-item" data-team-id="' + teamId + '">' + teamName +
                    '<button type="button" data-action="remove-team" class="btn btn-default btn-xs pull-right"><i class="fa fa-minus"></i></button></li>';
          $ul.append($li);
        }
        break;
      case 'remove-team':
        $(ev.target).parents('li').remove();
        break;
    }
  });
} )( jQuery );
