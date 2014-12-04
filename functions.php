<?php
if ( ! defined( 'THEME_PATH' ) ) define( 'THEME_PATH', get_template_directory() );
if ( ! defined( 'THEME_URL' ) )  define( 'THEME_URL',  get_template_directory_uri() );
include_once THEME_PATH . '/akaiv-wp-classes-setup.php';
include_once THEME_PATH . '/admin-functions.php';

require get_template_directory() . '/inc/class.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/head.php';
require get_template_directory() . '/inc/init.php';
require get_template_directory() . '/inc/post.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

$domain = 'http://www.football-data.org';

/* 리그별 팀 랭킹 */
function get_rank_by_league_id( $id ) {
  $rank_api = $GLOBALS['domain'] . '/soccerseasons/' . $id . '/ranking';
  $rank     = json_decode(wp_remote_get($rank_api)['body'], true);
  return $rank;
}

/* 리그별 경기 일정 (param(optional) : matchday, timeFrame(p|n)) */
function get_fixtures_by_league_id( $id ) {
  $fixtures_api = $GLOBALS['domain'] . '/soccerseasons/' . $id . '/fixtures';
  $fixtures     = wp_remote_get($fixtures_api);
  if ( is_wp_error( $fixtures ) ){
    return '[]';
  }
  return json_decode($fixtures['body'], true);
}

/* 팀별 경기 일정 * (param : season(ex.2014), timeFrame) */
function get_fixtures_by_team_id( $id ) {
  $team_fixtures_api = $GLOBALS['domain'] . '/teams/' . $id . '/fixtures';
  $team_fixtures     = json_decode(wp_remote_get($team_fixtures_api)['body'], true);
  return $team_fixtures;
}

/* 리그별 팀 목록 */
function get_teams_by_league_id( $id ) {
  $team_list_api = $GLOBALS['domain'] . '/soccerseasons/' . $id . '/teams';
  $team_list     = json_decode(wp_remote_get($team_list_api)['body'], true);
  return $team_list;
}

/* 리그 목록 */
function get_league_list() {
  $league_list_api = $GLOBALS['domain'] . '/soccerseasons';
  $league_list     = wp_remote_get($league_list_api)['body'];
  return $league_list;
}


/////////////////////////////////////////////
          /* wp_option에 저장하기 */
/////////////////////////////////////////////

/* 리그별 경기일정 저장 */
function set_fixtures_by_league_id( $id ) {
  $league_fixtures = get_fixtures_by_league_id( $id );

  $league_fixture_list = array();
  $league_fixture_list['updated_at'] = date(mktime());

  foreach( $league_fixtures as $league_fixture )
    $league_fixture_list['fixtures'][] = array(
      'id'            => $league_fixture['id'],
      'date'          => $league_fixture['date'],
      'matchday'      => $league_fixture['matchday'],
      'homeTeam'      => $league_fixture['homeTeam'],
      'awayTeam'      => $league_fixture['awayTeam'],
      'goalsHomeTeam' => $league_fixture['goalsHomeTeam'],
      'goalsAwayTeam' => $league_fixture['goalsAwayTeam']
    );
  update_option( $id . '_fixtures', $league_fixture_list );
}

/* 팀별 경기일정 저장
   내 팀관리목록에 있는 팀 일정들만 저장함 */
function set_fixtures_by_myteams() {
  $my_teams_fixtures = array();
  foreach ( get_option( 'my_teams' ) as $league_id ) {
    foreach ( $league_id as $team ) {
      $my_teams_fixtures = array_values( array_unique( array_merge( $my_teams_fixtures, get_fixtures_by_team_id( $team['team-id'] ) ), SORT_REGULAR ) );
    }
  }
  update_option( 'my_teams_fixtures', $my_teams_fixtures );
}

/* 리그별 팀 목록 저장 */
function set_teams_by_league_id( $id ) {
  $league_team_list = get_teams_by_league_id( $id );
  $team_list = get_option( 'league_teams', array() );
  foreach( $league_team_list as $league_team )
    $team_list[$id][] = array(
      'id'        => $league_team['id'],
      'name'      => $league_team['name'],
      'shortName' => $league_team['shortName'],
      'emblem'    => $league_team['crestUrl']
    );
  update_option( 'league_teams', $team_list );
}

/* 리그별 랭킹 저장 */
function set_rank_by_league_id( $id ) {
  $rank_arr = get_rank_by_league_id($id);
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
