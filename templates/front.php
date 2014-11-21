<?php
/* 리그별 팀 목록 wp_options에 저장하기 */
if ( empty( get_option( '354_teams', array() ) ) )
  setTeams( 354 );
$epl_fixtures = get_option( '354_fixtures', array() );
if ( empty( $epl_fixtures ) || ( ( date(mktime()) - $epl_fixtures['updated_at'] ) / 86400 ) >= 1 )
  setFixtures( 354 );
include_once THEME_PATH . '/templates/match-oftheday.php'; ?>

