<?php

// enqueue the child theme stylesheet

Function gofix_enqueue_scripts() {
	wp_enqueue_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
	wp_enqueue_script( 'childscript', get_stylesheet_directory_uri() . '/js/custom.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'gofix_enqueue_scripts', 11);
