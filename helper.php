<?php 
/*
Plugin Name: Helper
Author: Raihan Islam
Version: 1.0

*/

require dirname(__FILE__).'/elements/section-title.php';
require dirname(__FILE__).'/elements/small-title.php';
require dirname(__FILE__).'/elements/progressbar.php';
require dirname(__FILE__).'/elements/team.php';
require dirname(__FILE__).'/elements/testimonial.php';
require dirname(__FILE__).'/elements/news.php';
require dirname(__FILE__).'/elements/works.php';




add_action( 'init', 'praxis_works_init' );
/**
 * Register a Work post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function praxis_works_init() {
	$labels = array(
		'name'               => _x( 'Works', 'post type general name', 'your-plugin-textdomain' ),
		'singular_name'      => _x( 'Work', 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( 'Works', 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( 'Work', 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', 'Work', 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New Work', 'your-plugin-textdomain' ),
		'new_item'           => __( 'New Work', 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit Work', 'your-plugin-textdomain' ),
		'view_item'          => __( 'View Work', 'your-plugin-textdomain' ),
		'all_items'          => __( 'All Works', 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search Works', 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent Works:', 'your-plugin-textdomain' ),
		'not_found'          => __( 'No Works found.', 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( 'No Works found in Trash.', 'your-plugin-textdomain' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Description.', 'your-plugin-textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'Work' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
	);

	register_post_type( 'works', $args );
}

// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_book_taxonomies', 0 );

// create two taxonomies, genres and Category for the post type "book"
function create_book_taxonomies() {
	

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Category', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Category', 'textdomain' ),
		'popular_items'              => __( 'Popular Category', 'textdomain' ),
		'all_items'                  => __( 'All Category', 'textdomain' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Category', 'textdomain' ),
		'update_item'                => __( 'Update Category', 'textdomain' ),
		'add_new_item'               => __( 'Add New Category', 'textdomain' ),
		'new_item_name'              => __( 'New Category Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate Category with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove Category', 'textdomain' ),
		'choose_from_most_used'      => __( 'Choose from the most used Category', 'textdomain' ),
		'not_found'                  => __( 'No Category found.', 'textdomain' ),
		'menu_name'                  => __( 'Category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => true,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'Category' ),
	);

	register_taxonomy( 'works_cat', 'works', $args );
}

?>