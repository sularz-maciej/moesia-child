<?php
/** 
 * Register Custom Navigation Walker
 * https://github.com/twittem/wp-bootstrap-navwalker
 */
require_once('libs/wp_bootstrap_navwalker.php');


/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function moesia_child_widgets_init() {
	//Register the front page widgets
	if ( function_exists('siteorigin_panels_activate') ) {
		register_widget( 'Moesia_Who_We_Are' );
	}	
}
add_action( 'widgets_init', 'moesia_child_widgets_init' );

/**
 * Load the front page widgets.
 */
if ( function_exists('siteorigin_panels_activate') ) {
	require get_stylesheet_directory() . "/widgets/fp-whoweare.php";
}

add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' );
function enqueue_parent_theme_style() {

    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}


/**
 * Customizer additions.
 */
require get_stylesheet_directory() . '/inc/customizer.php';
/**
 * Dynamic styles
 */
require get_stylesheet_directory() . '/styles.php';