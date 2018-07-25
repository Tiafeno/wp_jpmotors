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

$total   = isset( $total ) ? $total : wc_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wc_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';
if ( $total <= 1 ) {
	return;
}

?>
<div class="pagination-wrapper uk-display-inline-block">
	<div class="pagination">
		<?php
		$pages = paginate_links(array(
				'base'      => $base,
				'format'    => $format,
				'prev_text' => 'prev',
				'next_text' => 'next',
				'add_args'     => false,
				'current'   => max( 1, $current ),
				'total'     => $total,
				'type'      => 'array'
		) );

		if ( is_array( $pages ) ) {
			$paged = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
			foreach ( $pages as $page ) {
				echo $page;
			}
		}
		?>

	</div>
</div>
