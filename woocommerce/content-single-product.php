<?php
/**
 * Copyright (c) 2018 Tiafeno Finel
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files, to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

defined( 'ABSPATH' ) || exit;
global $product, $jMotors;

/**
 * Hook: woocommerce_before_single_product.
 * @hooked wc_print_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( function_exists( 'get_field' ) ):
	$product_acf_field = $jMotors->services->get_product_acf($product->get_id());
endif;

// Get vehicle taxonomy
$vehicle = jServices::get_product_taxonomy_value($product->get_id(), 'jp_vehicles');
$vehicle = empty($vehicle) && ! is_array($vehicle) ? null : reset($vehicle);

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>

<style type="text/css">
	/*	Override woocommerce style */
	@media only screen and (min-width: 768px) {
		.woocommerce #content div.product div.images,
		.woocommerce div.product div.images,
		.woocommerce-page #content div.product div.images,
		.woocommerce-page div.product div.images {
			width: 100%;
		}
	}

</style>

<!-- single product page -->
<div class="uk-margin-small-top" uk-grid>
	<div class="uk-width-2-3@s uk-width-1-1">
		<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
			<div class="single-catalog-details">

				<div class="catalog-details-img uk-display-inline-block">
					<?php woocommerce_show_product_images() ?>
				</div>

				<div class="catalog-desc">
					<div class="catalog-feature uk-display-inline-block uk-margin-medium-top">
						<ul>
							<li>
								<img src="<?= get_template_directory_uri() ?>/img/icons/icon-1.png">
								<span class="uk-text-middle">
									<?php if ( ! is_null($vehicle)): echo $vehicle->name; endif; ?>
								</span>
							</li>
							<li>
								<img src="<?= get_template_directory_uri() ?>/img/icons/icon-2.png">
								<span class="uk-text-middle"><?= $product_acf_field->gearbox['label'] ?></span>
							</li>
							<li>
								<img src="<?= get_template_directory_uri() ?>/img/icons/icon-3.png">
								<span class="uk-text-middle"><?= $product_acf_field->fuel['label'] ?></span>
							</li>
							<li>
								<img src="<?= get_template_directory_uri() ?>/img/icons/icon-4.png">
								<span class="uk-text-middle">Vitesse <?= $product_acf_field->speed ?>km/h</span>
							</li>
						</ul>
					</div>

					<div class="catalog-details-content uk-margin-medium-top">
						<div class="uk-description-list">
							<h4 class="uk-text-bold">à propos</h4>
							<p><?= $product->get_description() ?></p>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="uk-width-1-3@s uk-width-1-1">
		<h1 class="catalog-title uk-margin-small-bottom"><?= $product->get_title() ?></h1>
		<h4 class="uk-margin-remove-top catalog-sub-title">lorem upsum dolor</h4>

		<div class="catalog-price uk-margin-medium-top">
			<div class="ui labels">
        <span class="ui red label price">
          <?= $product->get_price() ?>
        </span>
			</div>
		</div>

		<div class="catalog-button uk-margin-medium-top">
			<div>
				<a href="<?= $product_acf_field->discover ?>" class="ui negative basic button uk-width-1-1">Découvrir le véhicule</a>
			</div>
			<div class="uk-margin-small-top">
				<a href="<?= $product_acf_field->pdf ?>" class="ui primary basic button uk-width-1-1">
					<i class="icon download"></i>
					Télécharger le pdf
				</a>
			</div>
		</div>
	</div>

</div>


<?php do_action( 'woocommerce_after_single_product' ); ?>
