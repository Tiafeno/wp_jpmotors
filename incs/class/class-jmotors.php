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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'JMotors' ) ):
	class JMotors {
		public function __construct() {
			global $theme;

			// Appliquer la filtre sur la recherche des produits
			$this->filter_product_query();

			// Remove woocommerce filter in admin page
			add_filter( 'woocommerce_product_filters', function () {
				return "";
			}, 10 );

			add_action( 'wp_enqueue_scripts', function () use ( $theme ) {
				wp_enqueue_script( 'underscore' );
				wp_enqueue_script( 'jquery' );

				// load scripts
				wp_enqueue_script( 'bluebird', get_template_directory_uri() . '/assets/js/bluebird.min.js', ['jquery'], "3.5.0", true );
				wp_enqueue_script( 'numeral', get_template_directory_uri() . '/assets/js/numeral.min.js', [], "2.0.6", true );
				wp_enqueue_script( 'js-uikit', get_template_directory_uri() . '/assets/js/uikit.min.js', ['jquery'], "3.0.0-rc.9", true );
				wp_enqueue_script( 'ui-transition', get_template_directory_uri() . '/assets/css/components/transition.min.js', [], "2.3.3", true );
				wp_enqueue_script( 'ui-dropdown', get_template_directory_uri() . '/assets/css/components/dropdown.min.js', [], "2.3.3", true );
				wp_enqueue_script('jpmotors', get_template_directory_uri() . '/assets/js/jpmotors.js', ['jquery', 'js-uikit', 'bluebird'], $theme->get('Version'), true);

				// Load components semantic ui stylesheet
				wp_enqueue_style( 'ui-dropdown', get_template_directory_uri() . '/assets/css/components/dropdown.css', '', "2.3.3" );
				wp_enqueue_style( 'ui-button', get_template_directory_uri() . '/assets/css/components/button.css', '', "2.3.3" );
				wp_enqueue_style( 'ui-icon', get_template_directory_uri() . '/assets/css/components/icon.css', '', "2.3.3" );
				wp_enqueue_style( 'ui-card', get_template_directory_uri() . '/assets/css/components/card.css', '', "2.3.3" );
				wp_enqueue_style( 'ui-label', get_template_directory_uri() . '/assets/css/components/label.css', '', "2.3.3" );
				wp_enqueue_style( 'ui-transition', get_template_directory_uri() . '/assets/css/components/transition.min.css', '', "2.3.3" );
				wp_enqueue_style( 'ui-breadcrumb', get_template_directory_uri() . '/assets/css/components/breadcrumb.min.css', '', "2.3.3" );

				// Load uikit stylesheet
				wp_enqueue_style( 'style-uikit', get_template_directory_uri() . '/assets/css/uikit.css', '', "3.0.0-rc.9" );

				// Load the main stylesheet
				wp_enqueue_style( 'wp_jpmotors', get_stylesheet_uri(), '', $theme->get('Version') );
			} );

			// Wordpress initialization
			add_action('init', function () {

				// Now register the taxonomy (Mark)
				register_taxonomy('jp_mark', array('product'), [
					'hierarchical' => true,
					'labels' => [
						'name' => _x('Marques', 'taxonomy general name'),
						'singular_name' => _x('Marque', 'taxonomy singular name'),
						'search_items' => 'Trouver une marque',
						'all_items' => 'Trouver des marques',
						'parent_item' => 'Marque parent',
						'parent_item_colon' => 'Marque parent:',
						'edit_item' => 'Modifier la marque',
						'update_item' => 'Mettre à jour la marque',
						'add_new_item' => 'Ajouter une nouvelle marque',
						'menu_name' => 'Marques',
					],
					'show_ui' => true,
					'show_admin_column' => false,
					'query_var' => true,
					'rewrite' => array('slug' => 'marque'),
				]);

				// Now register the taxonomy (Condition)
				register_taxonomy('jp_condition', array('product'), [
					'hierarchical' => true,
					'labels' => [
						'name' => _x('Conditions', 'taxonomy general name'),
						'singular_name' => _x('Condition', 'taxonomy singular name'),
						'search_items' => 'Trouver une condition',
						'all_items' => 'Trouver des conditions',
						'parent_item' => 'Condition parent',
						'parent_item_colon' => 'Condition parent:',
						'edit_item' => 'Modifier la condition',
						'update_item' => 'Mettre à jour la condition',
						'add_new_item' => 'Ajouter une nouvelle condition',
						'menu_name' => 'Conditions',
					],
					'show_ui' => true,
					'show_admin_column' => false,
					'query_var' => true,
					'rewrite' => array('slug' => 'condition'),
				]);

				// Now register the taxonomy (Vehicules)
				register_taxonomy('jp_vehicles', array('product'), [
					'hierarchical' => true,
					'labels' => [
						'name' => _x('Véhicules', 'taxonomy general name'),
						'singular_name' => _x('Véhicule', 'taxonomy singular name'),
						'search_items' => 'Trouver un véhicule',
						'all_items' => 'Trouver des véhicules',
						'parent_item' => 'Vahicule parent',
						'parent_item_colon' => 'Véhicule parent:',
						'edit_item' => 'Modifier le véhicule',
						'update_item' => 'Mettre à jour le véhicule',
						'add_new_item' => 'Ajouter un nouveau véhicule',
						'menu_name' => 'Véhicules',
					],
					'show_ui' => true,
					'show_admin_column' => true,
					'query_var' => true,
					'rewrite' => array('slug' => 'vehicles'),
				]);

			});

			add_action('widgets_init', function() {
				// Register sidebar here
			});
		}

		public function filter_product_query() {
			add_action('woocommerce_product_query', function ($q) {
				$tax_query = $q->get('tax_query');

				if (self::getValue('mark')) {
					$mark = self::getValue('mark');
					$tax_query[] = array(
						'taxonomy' => 'jp_mark',
						'value' => $mark,
						'field' => 'slug',
						'operator' => 'IN'
					);
				}

				if (self::getValue('product_cat')) {
					$cat = self::getValue('product_cat');
					$tax_query[] = array(
						'taxonomy' => 'product_cat',
						'value' => $cat,
						'field' => 'slug',
						'operator' => 'IN'
					);
				}

				if (self::getValue('condition')) {
					$condition = self::getValue('condition');
					$tax_query[] = array(
						'taxonomy' => 'jp_condition',
						'value' => $condition,
						'field' => 'slug',
						'operator' => 'IN'
					);
				}

				// Set for global query
				$q->set('tax_query ', $tax_query);
			});
		}

		// Récuperer le lien image du logo
		public static function get_logo_uri() {
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
			return $image[0];
		}

		public static function getValue( $name, $def = false ) {
			if ( ! isset( $name ) || empty( $name ) || ! is_string( $name ) ) {
				return $def;
			}
			$returnValue = isset( $_POST[ $name ] ) ? trim( $_POST[ $name ] ) : ( isset( $_GET[ $name ] ) ? trim( $_GET[ $name ] ) : $def );
			$returnValue = urldecode( preg_replace( '/((\%5C0+)|(\%00+))/i', '', urlencode( $returnValue ) ) );

			return ! is_string( $returnValue ) ? $returnValue : stripslashes( $returnValue );
		}

		/**
		 * @param $location string
		 *
		 * @return array|false
		 */
		public static function get_menu_items_by_location( $location ) {
			$locations  = get_nav_menu_locations();
			$menu       = wp_get_nav_menu_object( $locations[ $location ] );
			$menu_items = wp_get_nav_menu_items( $menu->term_id );

			return $menu_items;
		}
	}
endif;

return new JMotors();
