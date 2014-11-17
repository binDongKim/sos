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

function getRankbyId( $id ) {
  $rank_api = $GLOBALS['domain'] . '/soccerseasons/' . $id . '/ranking';
  $rank     = json_decode(wp_remote_get($rank_api)['body'], true);
  return $rank;
}
