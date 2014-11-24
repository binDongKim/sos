<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <title><?php akaiv_title(); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo( 'name' ); ?> &mdash; 피드" href="<?php echo esc_url( get_feed_link() ); ?>">
  <!--[if lt IE 9]>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/html5shiv/dist/html5shiv.min.js"></script>
  <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/respond/dest/respond.min.js"></script>
  <![endif]-->
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<a class="skip-link sr-only" href="#content"><?php echo 'Skip to content'; ?></a>

<div class="container">
  <?php
    $flash_message = Akaiv_Flash::get_message();
    $flash_context = Akaiv_Flash::get_context();
    if ( ! empty( $flash_message ) ) :
  ?>
    <div class="alert alert-<?php echo $flash_context; ?> alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <?php echo $flash_message; ?>
    </div>
  <?php endif; ?>
</div>

<header id="masthead" class="site-header" role="banner">
  <nav id="gnb" class="site-navigation gnb navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#gnb-collapse">
          <span class="sr-only">메뉴 토글</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a id="brand" class="site-title navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
      </div>
      <div id="gnb-collapse" class="collapse navbar-collapse">
        <?php
        wp_nav_menu( array(
          'theme_location'    => 'gnb',
          'depth'             => 2,
          'container'         => 'ul',
          // 'container_id'      => 'gnb-collapse',
          // 'container_class'   => 'collapse navbar-collapse navbar-right',
          'menu_class'        => 'nav navbar-nav navbar-left',
          'fallback_cb'       => null,
          'walker'            => new wp_bootstrap_navwalker()
        ) );
        ?>

        <ul class="nav navbar-nav navbar-right">
          <?php if ( is_user_logged_in() ) : ?>
            <li><a href="<?php echo home_url( '/signout' ); ?>">로그아웃</a></li>
            <li><a href="<?php echo home_url( '/my-account' ); ?>"><?php echo (new Akaiv_User( get_current_user_id() ) )->username; ?></a></li>
          <?php else : ?>
            <li><a href="<?php echo home_url( '/signup' ); ?>">회원가입</a></li>
            <li><a href="<?php echo home_url( '/signin' ); ?>">로그인</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div><!-- .container -->
  </nav>
</header><!-- .site-header -->

<main id="main" class="site-main" role="main">
  <?php if ( ! is_home() && ! is_front_page() ) echo '<div class="container">'; ?>
