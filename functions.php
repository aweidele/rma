<?php
// Enqueue Scripts and Styles
function enqueue_styles() {

  wp_enqueue_style( 'main_style',
      get_stylesheet_directory_uri() . '/assets/css/main.css'
  );

  wp_enqueue_script( 'main_script',
    get_stylesheet_directory_uri() . '/assets/js/site.js',
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

add_image_size( 'hp', 570, 400, true );
add_image_size( 'dw', 1180, 400, true );
add_image_size( 'dt', 570, 720, true );
add_image_size( 'dwdt', 1180, 720, true );
add_image_size( 'grid', 500, 350, true );
add_image_size( 'portrait', 508, 768, true );
add_image_size( 'main', 990, 999999, false );
add_image_size( 'main-half', 495, 999999, false );

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Company Info',
		'menu_title'	=> 'Company Info',
		'menu_slug' 	=> 'company-info',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

// Custom Post Types
function custom_post_type() {
  // Projects
	$labels = array(
			'name'                  => _x( 'Projects', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Projects', 'text_domain' ),
			'name_admin_bar'        => __( 'Projects', 'text_domain' ),
			'archives'              => __( 'All Projects', 'text_domain' ),
			'attributes'            => __( '', 'text_domain' ),
			'parent_item_colon'     => __( '', 'text_domain' ),
			'all_items'             => __( 'All Projects', 'text_domain' ),
			'add_new_item'          => __( 'Add New Project', 'text_domain' ),
			'add_new'               => __( 'Add New Project', 'text_domain' ),
			'new_item'              => __( 'New Project', 'text_domain' ),
			'edit_item'             => __( 'Edit Project', 'text_domain' ),
			'update_item'           => __( 'Update Project', 'text_domain' ),
			'view_item'             => __( 'View Project', 'text_domain' ),
			'view_items'            => __( 'View Project', 'text_domain' ),
			'search_items'          => __( 'Search Projects', 'text_domain' ),
			'not_found'             => __( 'Not found', 'text_domain' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		);
		$args = array(
			'label'                 => __( 'Projects', 'text_domain' ),
			'description'           => __( 'Projects and Case Studies', 'text_domain' ),
			'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true,
	    'query_var' => true,
	    'menu_icon' => 'dashicons-hammer',
	    'capability_type' => 'post',
	    'hierarchical' => false,
	    'menu_position' => null,
	    'supports' => array( 'title', 'custom-fields', 'editor', 'page-attributes'),
	    'has_archive' => true,
			'rewrite' => array(
				'slug' => 'project'),
		);
		register_post_type( 'projects', $args );

    register_taxonomy(
      'industry',
      'projects',
      array(
          'labels' => array(
              'name'              => _x( 'Industries' , 'taxonomy general name' ),
              'singular_name'     => _x( 'Industry' , 'taxonomy singular name'),
              'add_new_item' => 'Add Industry',
              'new_item_name' => "New Industry"
          ),
          'show_ui' => true,
          'show_admin_column' => true,
          'show_tagcloud' => false,
          'hierarchical' => true,
          'support' => array('tags'),
          'rewrite' => array(
            'slug' => 'projects/industry'),
      )
    );

    // Projects
  	$labels = array(
  			'name'                  => _x( 'Staff', 'Post Type General Name', 'text_domain' ),
  			'singular_name'         => _x( 'Staff', 'Post Type Singular Name', 'text_domain' ),
  			'menu_name'             => __( 'Staff', 'text_domain' ),
  			'name_admin_bar'        => __( 'Staff', 'text_domain' ),
  			'archives'              => __( 'All Staff', 'text_domain' ),
  			'attributes'            => __( '', 'text_domain' ),
  			'parent_item_colon'     => __( '', 'text_domain' ),
  			'all_items'             => __( 'All Staff', 'text_domain' ),
  			'add_new_item'          => __( 'Add New Staff', 'text_domain' ),
  			'add_new'               => __( 'Add New Staff', 'text_domain' ),
  			'new_item'              => __( 'New Staff', 'text_domain' ),
  			'edit_item'             => __( 'Edit Staff', 'text_domain' ),
  			'update_item'           => __( 'Update Staff', 'text_domain' ),
  			'view_item'             => __( 'View Staff', 'text_domain' ),
  			'view_items'            => __( 'View Staff', 'text_domain' ),
  			'search_items'          => __( 'Search Staff', 'text_domain' ),
  			'not_found'             => __( 'Not found', 'text_domain' ),
  			'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
  		);
  		$args = array(
  			'label'                 => __( 'Staff', 'text_domain' ),
  			'description'           => __( 'Staff', 'text_domain' ),
  			'labels' => $labels,
  	    'public' => true,
  	    'publicly_queryable' => true,
  	    'show_ui' => true,
  	    'query_var' => true,
  	    'menu_icon' => 'dashicons-groups',
  	    'capability_type' => 'post',
  	    'hierarchical' => false,
  	    'menu_position' => null,
  	    'supports' => array( 'title', 'custom-fields', 'editor', 'page-attributes'),
  	    'has_archive' => true,
  			'rewrite' => array(
  				'slug' => 'staff'),
  		);
  		register_post_type( 'staff', $args );

  		flush_rewrite_rules();
}

add_action( 'init', 'custom_post_type', 0 );

function rma_img($img,$size) {
  $w = $size.'-width';
  $h = $size.'-height';
  $r = '<img src="'.$img['sizes'][$size].'"';
  $r .= ' width="'.$img['sizes'][$w].'"';
  $r .= ' height="'.$img['sizes'][$h].'"';
  if($img['alt']) {
    $r .= ' alt="'.$img['alt'].'"';
  }
  $r .= '>';
  return $r;
}

if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Header',
    'id'            => 'header-widget',
    'before_widget' => '<div class = "header_widget">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);
function modify_project_query( $query ) {
  if ( (
      $query->is_post_type_archive('projects')
      || $query->is_tax('industry')
      )
      && $query->is_main_query()
  ) {
    $query->query_vars['posts_per_page'] = -1;
  }

  if ( !isset($_GET['layout']) || $_GET['layout'] != 'table' ) {
    // $query->query_vars['meta_key'] = 'client';
    // $query->query_vars['meta_value'] = 'Client Name';
  }
}
add_action( 'pre_get_posts', 'modify_project_query' );
