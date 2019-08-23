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
if ( ! defined('ABSPATH')) {
	exit;
}

if ( ! class_exists('jServices')):
	class jServices {
		public function __construct () {}

		/*
		*	Recuperer les champs options sur le site
		*	@return false|object
		*/
		public function get_options() {
			if ( ! function_exists('get_field')) return false;
			$options = Array();
			$options_names = ['phone', 'address', 'email', 'brands'];
			foreach ($options_names as $name) {
				$options[$name] = get_field($name, 'option');
			}
			return (object)$options;
		}

		// Récuperer les post meta pour les champs ACF
		public function get_product_acf( $post_id )
		{
			if (function_exists('get_field')) {
				$post_id = intval($post_id);
				// récuperer les caractéristiques
				$gearbox = get_field('gearbox', $post_id);
				$fuel = get_field('fuel', $post_id);
				$speed_max = get_field('speed_max', $post_id);
				
                $discover_vehicle = get_field('discover_vehicle', $post_id); // Return url
                if (empty($discover_vehicle) || is_null($discover_vehicle)) {
                    $discover_vehicle = '#empty';
                }

                $pdf_file_link = '#empty';
                $pdf_file_id = get_field('pdf_file', $post_id); // return ID (number)
                if ($pdf_file_id)
                    $pdf_file_link = get_attachment_link((int) $pdf_file_id);

				return (object)[
					'gearbox' => $gearbox,
					'fuel' => $fuel,
					'speed' => $speed_max,
					'pdf' => $pdf_file_link,
					'discover' => $discover_vehicle
				];
			} else {
				return null;
			}
		}

		public static function get_product_taxonomy_value( $post_id, $taxonomy ) {
			if (taxonomy_exists($taxonomy)) {
				// @return array of term
				return wp_get_post_terms($post_id, $taxonomy, [
					// Filter
					"fields" => "all"
				]);
			} else return [];
		}

		// Retourne les contenues d'une taxonomie s'il existe
		public static function getTaxonomyContents ( $taxonomy )
		{
			if (taxonomy_exists($taxonomy)) {
				return get_terms([
					'taxonomy' => $taxonomy,
					'parent' => 0,
					'posts_per_page' => -1,
					'hide_empty' => false
				]);
			} else {
				return [];
			}
		}
	}
endif;
return new jServices();
