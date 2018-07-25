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
if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('jServices')):
	class jServices {
		public function __construct ()
		{

		}

		public static function getTaxonomyContents ( $taxonomy ) {
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