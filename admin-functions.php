<?php

add_action( 'admin_enqueue_scripts', function () {

  wp_enqueue_style( 'sos-admin-style', get_template_directory_uri() . '/css/style.css' );
  wp_enqueue_script( 'project-admin', get_template_directory_uri() . '/js/admin.js', array( 'jquery' ), '', true );
} );
