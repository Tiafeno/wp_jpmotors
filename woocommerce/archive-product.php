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

defined( 'ABSPATH' ) || exit;
get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */

woocommerce_output_content_wrapper();
?>
<style type="text/css">
	p.woocommerce-result-count {
		font-size: 13.5px;
		font-family: 'Montserrat', sans-serif;
	}
	select.orderby {
		width: 100%;
		background: #eceff8;
		border: 2px solid #eceff8;
		height: 45px;
		padding-left: 10px;
		box-shadow: none;
		font-size: 13px;
		color: #626262;
		font-family: 'Montserrat', sans-serif;
	}
</style>

	<div class="uk-section uk-section-large">
		<div class="uk-container uk-container-small">
			<div class="uk-width-1-1">
				<?php
				/**
				 * Hook: woocommerce_before_shop_loop.
				 *
				 * @hooked wc_print_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
				?>
			</div>
		</div>
		<div class="uk-container uk-container-small">
			<div class="archive-product">
				<div class="ui stackable link cards">
					<?php

					if ( woocommerce_product_loop() ) {

						if ( wc_get_loop_prop( 'total' ) ) {
							while ( have_posts() ) {
								the_post();

								/**
								 * Hook: woocommerce_shop_loop.
								 * @hooked WC_Structured_Data::generate_product_data() - 10
								 */
								do_action( 'woocommerce_shop_loop' );

								echo '<!--Single product section-->';
								wc_get_template_part( 'content', 'product' );
								echo '<!--Single product section end-->';
							}
						}

						/**
						 * Hook: woocommerce_after_shop_loop.
						 * @hooked woocommerce_pagination - 10
						 */
						do_action( 'woocommerce_after_shop_loop' );
					} else {
						/**
						 * Hook: woocommerce_no_products_found.
						 * @hooked wc_no_products_found - 10
						 */
						do_action( 'woocommerce_no_products_found' );
					}

					?>
				</div>
			</div>

		</div>
	</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
