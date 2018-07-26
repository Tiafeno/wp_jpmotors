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
 * Ajouter des filtres dans l'environement
 * @param object $Engine - Twig_Environment
 */
function jp_filter_engine( &$Engine ) {

	$Engine->addFilter( new Twig_SimpleFilter( 'get_the_permalink', function ( $id ) {
		return get_the_permalink( (int) $id );
	} ) );

	$Engine->addFilter( new Twig_SimpleFilter( 'woocommerce_get_product_thumbnail', function ($id) {
		return get_the_post_thumbnail( (int)$id, 'shop_catalog' );
	} ) );

	$Engine->addFilter( new Twig_SimpleFilter( 'get_description', function ($id) {
		$product = wc_get_product((int)$id);
		$title = $product->get_description();
		unset($product);
		return $title;
	} ) );

	$Engine->addFilter( new Twig_SimpleFilter( 'get_price', function ($id) {
		$product = wc_get_product((int)$id);
		$price = $product->get_price();
		unset($product);
		return $price;
	} ) );

}