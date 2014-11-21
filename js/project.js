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

    var $matchTbody = $('#match-oftheday tbody');
    if($('body').hasClass('page-match')) {
      $('#calendar').clndr({
        events: eplFixtures.fixtures,
        clickEvents: {
          click: function(target) {
            var calHeight = $('#calendar').height();

            $matchTbody.html('');

            var matchTableBody = '';
            target.events.forEach(function(match) {
              matchTableBody += getTableDomByJson(match);
            });
            if(matchTableBody===''){
              matchTableBody = '<tr><td colspan="6">No Match</td></tr>';
            }
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
    } else if($('body').hasClass('home')) {
      var matchTableBody = '';
      eplFixtures.fixtures.forEach(function(match) {
        if( moment().format('YYYYMMDD') === moment(moment.utc(match.date).toDate()).format('YYYYMMDD') ) {
          matchTableBody += getTableDomByJson(match);
        }
      });
      if(matchTableBody===''){
        matchTableBody = '<tr><td colspan="6">No Match</td></tr>';
      }
      $matchTbody.html(matchTableBody);
      $('#match-oftheday').css('display','block');
    }
    function getTableDomByJson(jsObj) {
      var domList = '';
      domList +=
      '<tr>' +
        '<td class="match-date">' + moment(moment.utc(jsObj.date).toDate()).format('HH:mm') + '</td>' +
        '<td class="team-emblem-name"><img src=' + teamEmblemObj[jsObj.homeTeam] + ' class="team-emblem">' + jsObj.homeTeam + '</td>' +
        '<td class="home-goals">' + ( jsObj.goalsHomeTeam === -1 ? '&nbsp;' : jsObj.goalsHomeTeam ) + '</td>' +
        '<td class="match-versus">vs</td>' +
        '<td class="away-goals">' + ( jsObj.goalsAwayTeam === -1 ? '&nbsp;' : jsObj.goalsAwayTeam ) + '</td>' +
        '<td class="team-emblem-name"><img src=' + teamEmblemObj[jsObj.awayTeam] + ' class="team-emblem">' + jsObj.awayTeam + '</td>' +
      '</tr>'
      return domList;
    }
  });
} )( jQuery );
