( function( $ ) {
  'use strict';

  $(window).load(function () {
    $('.loading').fadeOut('slow');
  });

  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('[data-league-filter]').change(function () {
      var leagueId = $(this).val();
      var url = '/sos/rank?league_id=' + leagueId + '&ajax_req=true';
      $('.loading').fadeIn('slow');
      $.get(url).then(function (dom) {
        $('.filtered-content').html(dom);
        $(".loading").fadeOut("slow");
        return true;
      });
    });
  });
} )( jQuery );
