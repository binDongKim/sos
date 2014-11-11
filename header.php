<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php wp_head(); ?>
  <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/html5shiv/dist/html5shiv.min.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/respond/dest/respond.min.js"></script>
  <![endif]-->
</head>

<body <?php body_class(); ?>>
<a class="sr-only skip-link" href="#content"><?php echo 'Skip to content'; ?></a>

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
  <div class="container">
    <h1 class="text-center"><a id="brand" class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
    <ul class="list-inline pull-right">
      <?php if ( is_user_logged_in() ) : ?>
        <li><a href="<?php echo home_url( '/signout' ); ?>">로그아웃</a></li>
        <li><a href="<?php echo home_url( '/my-account' ); ?>">마이페이지</a></li>
      <?php else : ?>
        <li><a href="<?php echo home_url( '/signup' ); ?>">회원가입</a></li>
        <li><a href="<?php echo home_url( '/signin' ); ?>">로그인</a></li>
      <?php endif; ?>
    </ul>
  </div>

  <nav id="gnb" class="site-navigation gnb navbar navbar-inverse" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#gnb-collapse">
          <span class="sr-only">메뉴 토글</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div id="gnb-collapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
          <li><a href>Match</a></li>
          <li><a href>Rank</a></li>
          <li><a href>Knowledge</a></li>
          <li><a href>News</a></li>
        </ul>
      </div>
    </div><!-- .container -->
  </nav>
</header><!-- #masthead -->

<div id="main" class="site-main">
  <?php if ( !is_front_page() ) echo '<div class="container">'; ?>
