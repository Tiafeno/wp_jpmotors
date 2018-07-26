<!DOCTYPE html>
<!--
  ~ Copyright (c) 2018 Tiafeno Finel
  ~
  ~ Permission is hereby granted, free of charge, to any person obtaining a copy
  ~ of this software and associated documentation files, to deal
  ~ in the Software without restriction, including without limitation the rights
  ~ to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
  ~ copies of the Software, and to permit persons to whom the Software is
  ~ furnished to do so, subject to the following conditions:
  ~
  ~ The above copyright notice and this permission notice shall be included in all
  ~ copies or substantial portions of the Software.
  ~
  ~ SOFTWARE.
  -->

<html class="no-js" <?= language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">

	<!--[if lt IE 9]>
		<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
	<script>
		(function($) {
			$(document).ready(function () {

			});
		})(jQuery)
	</script>
	<style type="text/css">

	</style>
</head>

<body <?php body_class(); ?> >

<!-- Page contents -->
<header class="uk-position-top" style="z-index:999">
	<div class="uk-section uk-section-transparent uk-padding-remove-vertical">
		<div class="uk-container uk-container-small">

			<div class="jp-header">
				<div class="uk-grid jp-header-grid uk-margin-remove-left">
					<div class="jp-bg-white uk-width-1-6@m uk-width-1-4@s uk-width-1-1 uk-padding-remove-left">
						<div class="jp-logo uk-display-flex">
							<a class="uk-display-block" href="<?= esc_url(home_url('/')) ?>">
								<img src="<?= JMotors::get_logo_uri() ?>" class="uk-margin-auto uk-margin-auto-vertical uk-display-block uk-logo"
								     style="height: 90px; width: auto"
								     alt=""/>
							</a>
						</div>
					</div>

					<div class="uk-width-5-6@m uk-width-3-4@s uk-width-1-1 uk-padding-remove-left">
						<div class="jp-navbar jp-navbar-top">
							<nav class="uk-navbar-container" uk-navbar>
								<div class="uk-navbar-left">
									<ul class="uk-navbar-nav">
										<li class="uk-active">
											<a href="#">
												<i class="icon large phone"></i>
												020 20 00 000
											</a>
										</li>
										<li>
											<a href="#">Lot n 5 Filatex Androndrakely 101 Antananarivo</a>
										</li>
									</ul>
								</div>
							</nav>
						</div>
						<div class="jp-navbar jp-navbar-primary">
							<nav class="uk-navbar-container" uk-navbar>
								<?php
								if (has_nav_menu('primary')) {
									wp_nav_menu( [
										'menu_class' => "uk-navbar-nav",
										'theme_location' => 'primary',
										'container_class' => 'uk-navbar-left',
										'walker' => new Primary_Walker
									] );
								}
								?>
							</nav>
						</div>

					</div>

				</div>
			</div>

			<!-- .end grid -->
		</div>
		<!-- .end container -->
	</div>
	<!-- .end section -->
</header>