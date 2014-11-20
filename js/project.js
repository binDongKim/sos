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

    if($('body').hasClass('page-match')) {
      var fixturesObj = fixtures;
      // console.log(moment(matchDate).format('YYYY-MM-DD HH:mm'));
      // var mObj = JSON.parse(JSON.stringify(fixtures));
      // for(var fixture in fixturesObj) {
      //   fixture.date = moment.utc(fixture.date).toDate();
      // }
      // console.log(fixturesObj);
      $('#calendar').clndr({
        events: fixturesObj,
        clickEvents: {
          click: function(target) {
            $('#match-list').html('');
            var matchDom = '';
            target.events.forEach(function(match) {
              console.log('homeTime: ' + match.homeTeam + ', awayTeam: ' + match.awayTeam);
              matchDom += '<article><span class="team-name-wrapper">' + match.homeTeam + '</span>' +
                               ' vs <span class="team-name-wrapper">' + match.awayTeam + '</span></article>';
              $('#match-list').html(matchDom);
              $('#match-ontheday').css('display','block');
            });
          },
          previousMonth: function(month) {
            $('#match-ontheday').css('display','none');
          },
          nextMonth: function(month) {
            $('#match-ontheday').css('display','none');
          }
        }
      });
    }
  });
} )( jQuery );
