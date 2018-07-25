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

class Primary_Walker extends Walker_Nav_Menu {
	var $db_fields = [
		'parent' => 'menu_item_parent',
		'id'     => 'db_id'
	];

	function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {
		if ( in_array( 'current-menu-item', $item->classes ) ) {
			$item->classes[] = 'uk-active';
		}
		$output .= sprintf( "\n <li class='%s'><a href='%s'>%s</a> \n", implode( ' ', $item->classes ), $item->url, $item->title );
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );
		$output .= "$indent</ul>{$n}";
		$output .= "$indent</div>{$n}";
	}

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );

		$classes     = array( 'uk-nav', 'uk-navbar-dropdown-nav' );
		$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$output      .= "<div class=\"uk-navbar-dropdown uk-margin-remove-top\">";
		$output      .= "{$n}{$indent}<ul$class_names>{$n}";
	}
}