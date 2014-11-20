<?php
if ( ! defined( 'THEME_PATH' ) ) define( 'THEME_PATH', get_template_directory() );
if ( ! defined( 'THEME_URL' ) )  define( 'THEME_URL',  get_template_directory_uri() );
include_once THEME_PATH . '/akaiv-wp-classes-setup.php';

require_once 'inc/class.php';
require_once 'inc/enqueue.php';
require_once 'inc/head.php';
require_once 'inc/init.php';
require_once 'inc/post.php';
require_once 'inc/template-tags.php';
require_once 'inc/wp_bootstrap_navwalker.php';

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
  $fixtures     = wp_remote_get($fixtures_api)['body'];
  return $fixtures;
}

/* 팀별 경기 일정 * (param : season(ex.2014), timeFrame) */
function getFixturesbyTeamId( $id ) {
  $team_fixtures_api = $GLOBALS['domain'] . '/teams' . $id . '/fixtures';
  $team_fixtures     = wp_remote_get($team_fixtures_api)['body'];
  return $team_fixtures;
}

/* 리그별 팀 목록 */
function getTeamsbyId( $id ) {
  $team_list_api = $GLOBALS['domain'] . '/soccerseasons' . $id . '/teams';
  $team_list     = wp_remote_get($team_list_api)['body'];
  return $team_list;
}

/* 리그 목록 */
function getLeagueList() {
  $league_list_api = $GLOBALS['domain'] . '/soccerseasons';
  $league_list     = wp_remote_get($league_list_api)['body'];
  return $league_list;
}
