<?php
if ( ! defined( 'THEME_PATH' ) ) define( 'THEME_PATH', get_template_directory() );
if ( ! defined( 'THEME_URL' ) )  define( 'THEME_URL',  get_template_directory_uri() );
include_once THEME_PATH . '/akaiv-wp-classes-setup.php';

require_once 'inc/class.php';         // HTML의 클래스
require_once 'inc/enqueue.php';       // 스타일시트, 자바스크립트, 파비콘, 타이틀
require_once 'inc/init.php';          // 테마 설정, 관리자
require_once 'inc/template-tags.php'; // 커스텀 템플릿태그
require_once 'inc/wp_bootstrap_navwalker.php'; // 부트스트랩 내비게이션
