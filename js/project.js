( function( $ ) {
  'use strict';

  $(window).load(function () {
    $('.loading').fadeOut('slow');
  });

  $(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    var teamEmblemObj = {};
    Object.keys(teamList).forEach(function (leagueId) {
      teamList[leagueId].forEach(function (team) {
        teamEmblemObj[team.name] = team.emblem ? (team.emblem.indexOf('http') !== -1 ? team.emblem : 'http://'.concat(team.emblem)) : themeDir + '/images/no_image.svg';

      });
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
    myTeamsFixtures.sort(function (fix1, fix2) {
      return new Date(fix1.date) - new Date(fix2.date);
    });
    var $matchDiv = $('#match-oftheday');
    if($('body').hasClass('page-match')) {
      $('#calendar').clndr({
        events: myTeamsFixtures,
        clickEvents: {
          click: function(target) {
            var calHeight = $('#calendar').height();

            $matchDiv.find('thead').find('td').html('');
            $matchDiv.find('tbody').html('');

            var matchTableBody = '';
            target.events.forEach(function(match) {
              matchTableBody += getTableDomByJson(match);
            });
            if(matchTableBody===''){
              matchTableBody = '<tr><td colspan="6">No Match</td></tr>';
            }
            $matchDiv.find('thead').find('td').html('Matches on ' + '<span class="match-date-wrapper">' + target.date._i + '</span>');
            $matchDiv.find('tbody').html(matchTableBody);

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
      myTeamsFixtures.forEach(function(match) {
        if( moment().format('YYYYMMDD') === moment(moment.utc(match.date).toDate()).format('YYYYMMDD') ) {
          matchTableBody += getTableDomByJson(match);
        }
      });
      if(matchTableBody===''){
        matchTableBody = '<tr><td colspan="6">No Match</td></tr>';
      }
      $matchDiv.find('thead').find('td').html('<span class="match-date-wrapper">Today</span>' + '\'s Matches');
      $matchDiv.find('tbody').html(matchTableBody);
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
