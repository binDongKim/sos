( function( $ ) {
  'use strict';
  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('[data-league-filter]').change(function () {
      var leagueId = $(this).val();
      var url = '/sos/rank?league_id=' + leagueId + '&ajax_req=true';
      $.get(url).then(function (dom) {
        $('.filtered-content').html(dom);
        return true;
      })
    });
  });
} )( jQuery );
