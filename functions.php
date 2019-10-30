<?php
// Enqueue Scripts and Styles
function enqueue_styles() {

  wp_enqueue_style( 'main_style',
      get_stylesheet_directory_uri() . '/assets/css/main.css'
  );

  wp_enqueue_script( 'main_script',
    get_stylesheet_directory_uri() . '/js/site.js',
    array('jquery'),
    wp_get_theme()->get('Version'),
    true
  );

}
add_action( 'wp_enqueue_scripts', 'enqueue_styles' );


// Register Menu
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
  register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
}
