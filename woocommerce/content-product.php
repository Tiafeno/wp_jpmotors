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
global $product;
// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

?>

<div class="card product-list" data-url="<?= get_the_permalink() ?>">
	<div class="image">
		<?= woocommerce_get_product_thumbnail(); ?>
	</div>
	<div class="content">
		<div class="header"><?= $product->get_title() ?></div>
		<div class="meta">
			<a>Friends</a>
		</div>
		<div class="description">
			<?= $product->get_description() ?>
		</div>
	</div>
	<div class="extra content">
		<div class="ui labels">
      <span class="ui red label price">
        <?= $product->get_price() ?>
      </span>
		</div>
	</div>
</div>

