<?php
if ( ! defined( 'ABSPATH' ) ) die();

if ( ! defined( 'AKAIV_WP_CLASSES_PATH' ) ) define( 'AKAIV_WP_CLASSES_PATH', THEME_PATH . '/akaiv-wp-classes' );
if ( ! defined( 'ADMIN_MENUS_PATH' ) )      define( 'ADMIN_MENUS_PATH',      THEME_PATH . '/admin-menus' );

require_once AKAIV_WP_CLASSES_PATH . '/interface-akaiv-loggable.php';
require_once AKAIV_WP_CLASSES_PATH . '/interface-akaiv-meta-handleable.php';

require_once AKAIV_WP_CLASSES_PATH . '/class-akaiv-admin-menu.php';
require_once AKAIV_WP_CLASSES_PATH . '/class-akaiv-ajax.php';
require_once AKAIV_WP_CLASSES_PATH . '/class-akaiv-content.php';
require_once AKAIV_WP_CLASSES_PATH . '/class-akaiv-flash.php';
require_once AKAIV_WP_CLASSES_PATH . '/class-akaiv-page.php';
require_once AKAIV_WP_CLASSES_PATH . '/class-akaiv-user.php';
require_once AKAIV_WP_CLASSES_PATH . '/class-akaiv-user-profile.php';
require_once AKAIV_WP_CLASSES_PATH . '/class-akaiv-utils.php';

// Knowledge
Akaiv_Content::register_post_type( 'knowledge', 'Knowledge', array(
  'public'          => true,
  'menu_position'   => 30,
  'menu_icon'       => 'dashicons-welcome-learn-more',
  'capability_type' => 'post',
  'supports'        => array( 'title', 'editor', 'thumbnail' ),
  'taxonomies'      => array( 'knowledge_type' ),
  'has_archive'     => true,
) );
Akaiv_Content::register_taxonomy( 'knowledge_type', 'knowledge', 'knowledge_type', array(
  'public'            => true,
  'show_tagcloud'     => false,
  'show_admin_column' => true,
  'hierarchical'      => true
) );
Akaiv_Content::manage_custom_columns( 'knowledge', function ( $columns ) {
  return array(
    'cb'                      => '<input type="checkbox">',
    'title'                   => 'Title',
    'taxonomy-knowledge_type' => 'Type',
    'date'                    => 'Date'
  );

} );
Akaiv_Content::manage_custom_column( 'knowledge', function ( $column, $post_id ) {
  switch( $column ) {
    default :
      break;
  }

} );

Akaiv_Content::register_post_type( 'news', 'News', array(
  'public'          => true,
  'menu_position'   => 31,
  'menu_icon'       => 'dashicons-megaphone',
  'capability_type' => 'post',
  'supports'        => array( 'title', 'editor', 'thumbnail' ),
  'has_archive'     => true,
) );
Akaiv_Content::manage_custom_columns( 'news', function ( $colummns ) {
  return array(
    'cb' => '<input type="checkbox">',
    'thumbnail' => '',
    'title' => 'Title',
    'date' => 'Date'
  );

} );
Akaiv_Content::manage_custom_column( 'news', function ( $column, $post_id ) {
  switch( $column ) {
    case 'thumbnail':
      echo get_the_post_thumbnail( get_the_ID(), array( 100, 100 ) );
      break;
  }

} );

Akaiv_Admin_Menu::add_menu( array(
  'page_title' => 'Team Management',
  'menu_title' => 'Team Management',
  'menu_slug'  => 'teams',
  'icon_url'   => 'dashicons-groups',
  'template'   => ADMIN_MENUS_PATH . '/team-management.php',
  'position'   => 40
), 'manage_options' );


Akaiv_Page::setup_router( function ( $path ) {
  switch ( $path ) {
    case 'signin':
      if ( is_user_logged_in() )
        return wp_redirect( home_url() );

      status_header( 200 );
      if ( 'POST' === $_SERVER['REQUEST_METHOD'] && Akaiv_Utils::is_nonce_success( 'signin' ) ) {
        if ( ! is_wp_error( wp_signon() ) ) {
          Akaiv_Flash::set( '로그인하였습니다.', 'success' );
          wp_redirect( empty( $_POST['redirect_to'] ) ? home_url() : $_POST['redirect_to'] );
          die();
        }

        status_header( 403 );
        Akaiv_Flash::set( '아이디 또는 비밀번호가 틀렸습니다.', 'warning' );
      }

      Akaiv_Page::set_title( '로그인' );
      Akaiv_Page::set_body_class( 'page-signin' );
      include_once THEME_PATH . '/pages/signin.php';

      die();

    case 'signin/lost-password':
      if ( is_user_logged_in() )
        return wp_redirect( home_url() );

      status_header( 200 );
      Akaiv_Page::set_title( '비밀번호 분실' );
      Akaiv_Page::set_body_class( 'page-lost-password' );
      include_once THEME_PATH . '/pages/lost-password.php';

      die();

    case 'signout':
      wp_logout();
      Akaiv_Flash::set( '로그아웃하였습니다.', 'success' );
      wp_redirect( home_url() );

      die();


    case 'signup':
      if ( is_user_logged_in() )
        return wp_redirect( home_url() );

      status_header(200);
      if ( 'POST' === $_SERVER['REQUEST_METHOD'] && Akaiv_Utils::is_nonce_success( 'signup' ) ) {
        if ( $_POST['user_pass'] !== $_POST['user_pass2'] )
          Akaiv_Flash::set( '두 비밀번호는 같아야 합니다.', 'warning' );
        else {
          $new_user = Akaiv_User::create( $_POST, $_FILES['profile'] );
          if ( 'object' === gettype( $new_user ) ) {
            Akaiv_Flash::set( '회원가입이 완료되었습니다. 로그인하세요.', 'success' );
            wp_redirect( home_url( '/signin' ) );
            die();
          } else
            Akaiv_Flash::set( $new_user, 'danger' );
        }

        status_header( 400 );
      }

      Akaiv_Page::set_title( '회원가입' );
      Akaiv_Page::set_body_class( 'page-signup' );
      include_once THEME_PATH . '/pages/signup.php';

      die();

    case 'withdraw':
      if ( ! is_user_logged_in() )
        return wp_redirect( home_url() );

      status_header(200);
      if ( 'POST' === $_SERVER['REQUEST_METHOD'] && Akaiv_Utils::is_nonce_success( 'withdraw-' . get_current_user_id() ) ) {
        if ( ( new Akaiv_User( get_current_user_id() ) )->withdraw( $_POST['password'] ) ) {
          Akaiv_Flash::set( '회원탈퇴가 완료되었습니다.', 'success' );
          wp_redirect( home_url( '/' ) );
          die();
        }

        status_header( 403 );
        Akaiv_Flash::set( '비밀번호가 틀렸습니다.', 'warning' );
      }

      Akaiv_Page::set_title( '회원탈퇴' );
      Akaiv_Page::set_body_class( 'page-withdraw' );
      include_once THEME_PATH . '/pages/withdraw.php';

      die();

    case 'my-account':
      if ( ! is_user_logged_in() )
        return wp_redirect( home_url( '/signin?redirect_to=' . home_url( '/my-account' ) ) );

      status_header(200);
      if ( 'POST' === $_SERVER['REQUEST_METHOD'] && Akaiv_Utils::is_nonce_success( 'my-account-' . get_current_user_id() ) ) {
        if ( $_POST['user_pass'] !== $_POST['user_pass2'] )
          Akaiv_Flash::set( '두 비밀번호는 같아야 합니다.', 'warning' );
        else {
          $updated_user = ( new Akaiv_User( get_current_user_id() ) )->update( $_POST, $_FILES['profile'] );
          if ( 'object' === gettype( $updated_user ) ) {
            Akaiv_Flash::set( '회원정보가 변경되었습니다.', 'success' );
            wp_redirect( home_url( '/my-account' ) );
            die();
          } else
            Akaiv_Flash::set( $updated_user, 'danger' );
        }

        status_header( 403 );
      }

      Akaiv_Page::set_title( '회원정보 변경' );
      Akaiv_Page::set_body_class( 'page-my-account' );
      $user = new Akaiv_User( get_current_user_id() );
      include_once THEME_PATH . '/pages/my-account.php';

      die();

    case 'match':
      status_header(200);
      Akaiv_Page::set_title( 'Match' );
      Akaiv_Page::set_body_class( 'page-match' );
      include_once THEME_PATH . '/pages/match.php';

      die();

    case 'rank':
      status_header(200);
      $league_id = $_GET['league_id'] ? $_GET['league_id'] : 354;
      $ajax_req = empty( $_GET['ajax_req'] ) ? false : true;

      $team_rank = get_option( $league_id . '_rank', array() );

      if ( empty( $team_rank ) || ( ( date(mktime()) - $team_rank['updated_at'] ) / 3600 ) >= 1 ) {
        setRank( $league_id );
      }
      $team_rank = get_option( $league_id . '_rank', array() );
      Akaiv_Page::set_title( 'Rank' );
      Akaiv_Page::set_body_class( 'page-rank' );
      include_once THEME_PATH . '/pages/rank.php';

      die();
  }

} );
