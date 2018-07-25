<?php
/**
 *   Copyright (c) 2018, Falicrea
 *
 *   Permission is hereby granted, free of charge, to any person obtaining a copy
 *   of this software and associated documentation files, to deal
 *   in the Software without restriction, including without limitation the rights
 *   to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *   copies of the Software, and to permit persons to whom the Software is
 *   furnished to do so, subject to the following conditions:
 *
 *   The above copyright notice and this permission notice shall be included in all
 *   copies or substantial portions of the Software.
 */

define( '__SITENAME__', 'JPMotors' );
define( '__google_api__', base64_decode( 'QUl6YVN5Qng3LVJKbGlwbWU0YzMtTGFWUk5oRnhiV19xWG5DUXhj' ) );
$theme = wp_get_theme( 'wp_jpmotors' );

$jMotors = (object) [
	'version'  => $theme->get( 'Version' ),
	'root'     => require 'incs/class/class-jmotors.php',
	'services' => require 'incs/class/class-jservices.php'
];

require 'incs/class/class-menu-walker.php';

// Autoload composer libraries
require 'composer/vendor/autoload.php';

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'twentyfifteen' );
	load_theme_textdomain( __SITENAME__, get_template_directory() . '/languages' );

	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'category-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 250,
		'flex-width' => true,
	) );

	// Render this template compatible with woocommerce
	add_theme_support( 'woocommerce', [
		'thumbnail_image_width'         => 360,
		'gallery_thumbnail_image_width' => 150,
		'single_image_width'            => 600,
	] );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Register menu location
	register_nav_menus( array(
		'primary'  => __( 'Primary Menu', 'twentyfifteen' ),
		'menu-top' => __( 'Top Menu', __SITENAME__ )
	) );


} );