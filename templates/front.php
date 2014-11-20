<?php
/* 리그별 팀 목록 wp_options에 저장하기 */
if ( empty( get_option( 354 . '_teams', array() ) ) ) {
  $epl_team_list = getTeamsById(354);
  $team_list = array();
  foreach( $epl_team_list as $epl_team )
    $team_list[] = array(
      'id'        => $epl_team['id'],
      'name'      => $epl_team['name'],
      'shortName' => $epl_team['shortName'],
      'emblem'    => $epl_team['crestUrl']
    );
  update_option( 354 . '_teams', $team_list );
} ?>

