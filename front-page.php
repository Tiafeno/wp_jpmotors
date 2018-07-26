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

get_header();
?>

	<!-- slider -->
<?php
if ( function_exists( 'get_field' ) ) {
	$slider                   = new stdClass();
	$slider->animation        = get_field( 'animations', 'option' );
	$slider->autoplay         = get_field( 'autoplay', 'option' );
	$slider->autoplayInterval = get_field( 'autoplay-interval', 'option' );
	$slider->ratio            = get_field( 'ratio', 'option' );
	$slider->galeries         = get_field( 'galeries', 'option' );
	?>
	<div class="jp-slider">
		<div class="uk-position-relative uk-visible-toggle uk-light"
		     uk-slideshow="ratio: <?= $slider->ratio ?>; animation: <?= $slider->animation ?>; autoplay-interval: <?= $slider->autoplayInterval ?>; autoplay: <?= ( $slider->autoplay ) ? 'true' : 'false' ?>">

			<ul class="uk-slideshow-items">
				<?php foreach ( $slider->galeries as $galerie ) : ?>
					<li>
						<img data-src="<?= $galerie['url'] ?>" width="<?= $galerie['width'] ?>" height="<?= $galerie['height'] ?>"
						     alt="" uk-cover
						     uk-img="target: !.uk-slideshow-items">
					</li>
				<?php endforeach; ?>
			</ul>

			<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous
			   uk-slideshow-item="previous"></a>
			<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next
			   uk-slideshow-item="next"></a>

		</div>
	</div>
	<?php
}
?>
	<!-- .end slider -->

	<!-- search -->
	<div class="jp-search">
		<div class="uk-section uk-section-secondary jp-search">
			<div class="uk-container uk-container-small">
				<form name="jpsearch" role="search" method="get" action="<?= esc_url( home_url( '/' ) ) ?>">
					<div uk-grid>
						<div class="uk-width-2-3@s uk-width-1-1">
							<div uk-grid>
								<div class="uk-width-1-2@s uk-width-1-1">
									<input class="uk-input" name="s" value="<?= get_search_query() ?>" type="text"
									       placeholder="Que recherchez-vous?">
								</div>
								<div class="uk-width-1-2@s uk-width-1-1">
									<div class="uk-form-controls">
										<select class="uk-select" name="mark">
											<option value="">Tous les marques</option>
											<?php
											foreach ( jServices::getTaxonomyContents( 'jp_mark' ) as $mark ) {
												printf( "<option value='%s'>%s</option>", $mark->slug, ucfirst( $mark->name ) );
											}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="uk-hidden@s uk-margin-medium-top"></div>
							<div class="uk-margin-small-top" uk-grid>
								<div class="uk-width-1-3@s uk-width-1-1">
									<div class="uk-form-controls">
										<select class="uk-select" name="product_cat">
											<option value="">Tous les types</option>
											<?php
											foreach ( jServices::getTaxonomyContents( 'product_cat' ) as $cat ) {
												printf( "<option value='%s'>%s</option>", $cat->slug, ucfirst( $cat->name ) );
											}
											?>
										</select>
									</div>
								</div>
								<div class="uk-width-1-3@s uk-width-1-1">
									<input class="uk-input" name="price_max" placeholder="Prix maxi" type="number">
								</div>
								<div class="uk-width-1-3@s uk-width-1-1">
									<div class="uk-form-controls">
										<select class="uk-select" name="condition">
											<option value="">Neuve & Occasion</option>
											<?php
											foreach ( jServices::getTaxonomyContents( 'jp_condition' ) as $condition ) {
												printf( "<option value='%s'>%s</option>", $condition->slug, ucfirst( $condition->name ) );
											}
											?>
										</select>
									</div>
								</div>
							</div>

						</div>

						<div class="uk-width-1-3@s uk-width-1-1">
							<!-- Activer la recherche pour woocommerce filtre -->
							<input type="hidden" name="post_type" value="product"/>
							<button type="submit" class="uk-button uk-button-danger">Trouver</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- .end search -->

	<div class="uk-section uk-margin-remove-top">
		<div class="uk-container uk-container-small">
			<?php
			while ( have_posts() ) : the_post();
				the_content();
			endwhile;
			?>
		</div>
	</div>

<?php get_footer(); ?>