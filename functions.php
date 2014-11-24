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
