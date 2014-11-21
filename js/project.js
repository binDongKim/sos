( function( $ ) {
  'use strict';

  $(window).load(function () {
    $('.loading').fadeOut('slow');
  });

  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    var teamEmblemObj = {};
    eplTeamList.forEach(function(eplTeam) {
      teamEmblemObj[eplTeam.name] = eplTeam.emblem ? eplTeam.emblem : themeDir + '/images/no_image.svg';
    });

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
      console.log(eplFixtures);
      $('#calendar').clndr({
        events: eplFixtures.fixtures,
        clickEvents: {
          click: function(target) {
            var $matchTbody = $('#match-oftheday tbody');
            var calHeight = $('#calendar').height();

            $matchTbody.html('');

            var matchTableBody = '';
            target.events.forEach(function(match) {
              matchTableBody +=
              '<tr>' +
                '<td class="match-date">' + moment(moment.utc(match.date).toDate()).format('HH:mm') +     '</td>' +
                '<td class="team-emblem-name"><img src='    + teamEmblemObj[match.homeTeam] + ' class="team-emblem">' + match.homeTeam + '</td>' +
                '<td class="home-goals">' + ( match.goalsHomeTeam === -1 ? '&nbsp;' : match.goalsHomeTeam ) + '</td>' +
                '<td class="match-versus">vs</td>' +
                '<td class="away-goals">' + ( match.goalsAwayTeam === -1 ? '&nbsp;' : match.goalsAwayTeam ) + '</td>' +
                '<td class="team-emblem-name"><img src='    + teamEmblemObj[match.awayTeam] + ' class="team-emblem">' + match.awayTeam + '</td>' +
              '</tr>'
            });
            $matchTbody.html(matchTableBody);
            $('#match-oftheday').css('max-height', calHeight-39);
            $('#match-oftheday').css('display','block');
          },
          previousMonth: function(month) {
            $('#match-oftheday').css('display','none');
          },
          nextMonth: function(month) {
            $('#match-oftheday').css('display','none');
          }
        }
      });
    }
  });
} )( jQuery );
