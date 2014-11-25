<?php
if ( ! defined( 'THEME_PATH' ) ) define( 'THEME_PATH', get_template_directory() );
if ( ! defined( 'THEME_URL' ) )  define( 'THEME_URL',  get_template_directory_uri() );
include_once THEME_PATH . '/akaiv-wp-classes-setup.php';

require get_template_directory() . '/inc/class.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/head.php';
require get_template_directory() . '/inc/init.php';
require get_template_directory() . '/inc/post.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

$domain = 'http://www.football-data.org';

/* 리그별 팀 랭킹 */
function getRankbyId( $id ) {
  $rank_api = $GLOBALS['domain'] . '/soccerseasons/' . $id . '/ranking';
  $rank     = json_decode(wp_remote_get($rank_api)['body'], true);
  return $rank;
}

/* 리그별 경기 일정 (param(optional) : matchday, timeFrame(p|n)) */
function getFixturesbyId( $id ) {
  $fixtures_api = $GLOBALS['domain'] . '/soccerseasons/' . $id . '/fixtures';
  $fixtures     = wp_remote_get($fixtures_api);
  if ( is_wp_error( $fixtures ) ){
    return '[]';
  }
  return json_decode($fixtures['body'], true);
}

/* 팀별 경기 일정 * (param : season(ex.2014), timeFrame) */
function getFixturesbyTeamId( $id ) {
  $team_fixtures_api = $GLOBALS['domain'] . '/teams/' . $id . '/fixtures';
  $team_fixtures     = wp_remote_get($team_fixtures_api)['body'];
  return $team_fixtures;
}

/* 리그별 팀 목록 */
function getTeamsbyId( $id ) {
  $team_list_api = $GLOBALS['domain'] . '/soccerseasons/' . $id . '/teams';
  $team_list     = json_decode(wp_remote_get($team_list_api)['body'], true);
  return $team_list;
}

/* 리그 목록 */
function getLeagueList() {
  $league_list_api = $GLOBALS['domain'] . '/soccerseasons';
  $league_list     = wp_remote_get($league_list_api)['body'];
  return $league_list;
}


/////////////////////////////////////////////
          /* wp_option에 저장하기 */
/////////////////////////////////////////////

/* 경기일정 저장 */
function setFixtures( $id ) {
  $epl_fixtures = getFixturesbyId( $id );

  $epl_fixture_list = array();
  $epl_fixture_list['updated_at'] = date(mktime());

  foreach( $epl_fixtures as $epl_fixture )
    $epl_fixture_list['fixtures'][] = array(
      'id'            => $epl_fixture['id'],
      'date'          => $epl_fixture['date'],
      'matchday'      => $epl_fixture['matchday'],
      'homeTeam'      => $epl_fixture['homeTeam'],
      'awayTeam'      => $epl_fixture['awayTeam'],
      'goalsHomeTeam' => $epl_fixture['goalsHomeTeam'],
      'goalsAwayTeam' => $epl_fixture['goalsAwayTeam']
    );
  update_option( $id . '_fixtures', $epl_fixture_list );
}

/* 팀 목록 저장 */
function setTeams( $id ) {
  $epl_team_list = getTeamsById( $id );
  $team_list = array();
  foreach( $epl_team_list as $epl_team )
    $team_list[] = array(
      'id'        => $epl_team['id'],
      'name'      => $epl_team['name'],
      'shortName' => $epl_team['shortName'],
      'emblem'    => $epl_team['crestUrl']
    );
  update_option( $id . '_teams', $team_list );
}

/* 리그 별 랭킹 저장 */
function setRank( $id ) {
  $rank_arr = getRankById($id);
  $team_rank = array();
  $team_rank['updated_at']  = date(mktime());
  $team_rank['league_name'] = $rank_arr['league'];
  foreach( $rank_arr['ranking'] as $rank )
    $team_rank['ranking'][] = array(
      'rank'           => $rank['rank'],
      'team'           => $rank['team'],
      'emblem'         => $rank['crestURI'],
      'points'         => $rank['points'],
      'goals'          => $rank['goals'],
      'goalsAgainst'   => $rank['goalsAgainst'],
      'goalDifference' => $rank['goalDifference']
    );
  update_option( $id . '_rank', $team_rank );
}
