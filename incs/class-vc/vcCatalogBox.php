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

/**
 * Created by IntelliJ IDEA.
 * User: Tiafeno
 * Date: 26/07/2018
 * Time: 11:16
 */
class vcCatalogBox extends WPBakeryShortCode {
	public function __construct() {
		add_action( 'init', [ $this, 'vc_catalog_mapping' ] );
		add_shortcode( 'vc_catalog', [ $this, 'vc_catalog_html' ] );
		add_action( 'wp_enqueue_scripts', array( $this, 'loadCallbackScript' ) );
	}

	public function vc_catalog_mapping() {
		// Stop all if VC is not enabled
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}
		// Map the block with vc_map()
		vc_map(
			array(
				'name'        => __( 'VC Catalog', __SITENAME__ ),
				'base'        => 'vc_catalog',
				'description' => 'Afficher la liste des catalogues récemment ajoutée.',
				'category'    => __( 'JP Motors', __SITENAME__ ),
				'params'      => array(
					[
						'type'        => 'textfield',
						'holder'      => 'h3',
						'heading'     => 'Titre',
						'param_name'  => 'title',
						'value'       => '',
						'description' => __( 'Ajouter une titre', __SITENAME__ )
					],
					[
						'type'        => 'textfield',
						'holder'      => 'div',
						'param_name'  => 'loop_count',
						'class'       => '',
						'value'       => 6,
						'description' => 'Nombre maximun des catalogue a afficher'
					]
				)
			)
		);
	}

	public function loadCallbackScript() {
		global $jMotors;
		wp_enqueue_script( 'vc_catalog_js', get_template_directory_uri() . '/assets/vc/vc-catalog.js', [ 'jquery' ], $jMotors->version, true );
	}

	private function getContents( $limiteCols = 6 ) {
		$args = [
			'post_type'   => 'product',
			'post_status' => 'publish',
			'numberposts' => (int) $limiteCols
		];

		/** @var array $catalogs - List of WP_Post objects */
		$catalogs = get_posts( $args );

		return $catalogs;
	}

	public function vc_catalog_html( $atts ) {
		global $Engine;

		// Params extraction
		extract(
			shortcode_atts(
				array(
					'title'      => '',
					'loop_count' => 6
				),
				$atts
			)
		);

		try {
			/** @var string $title */
			/** @var string $loop_count */
			return $Engine->render( '@VC/catalog-lists.html', [
				// TODO: Afficher le titre dans le template
				'title'    => $title,
				'catalogs' => $this->getContents( (int) $loop_count )

			] );
		} catch ( Twig_Error_Loader $e ) {
		} catch ( Twig_Error_Runtime $e ) {
		} catch ( Twig_Error_Syntax $e ) {
			echo $e->getRawMessage();
		}

	}
}

return new vcCatalogBox();