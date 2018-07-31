<!-- footer -->
<footer>
<?php if (function_exists('get_field')): ?>
	<div class="uk-section uk-section-large uk-padding-remove-vertical jp-brands">
		<div class="uk-container uk-container-small uk-margin-top uk-margin-bottom">
			<div class="jp-logo-brands">
				<!-- sidebar register content footer -->
				<?php
				// @link https://www.advancedcustomfields.com/resources/gallery/
				$brands = get_field('brands', 'option');
				?>
				<div class="uk-position-relative uk-visible-toggle uk-light"
				     uk-slider="autoplay: true; autoplay-interval: 2500">

					<ul class="uk-slider-items uk-child-width-1-3 uk-child-width-1-6@s uk-grid">
						<?php foreach ($brands as $brand): ?>
						<li>
							<div class="uk-panel">
								<img src="<?= $brand['sizes']['medium_large'] ?>" alt="">
							</div>
						</li>
						<?php endforeach; ?>

					</ul>

					<a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous
					   uk-slider-item="previous"></a>
					<a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next
					   uk-slider-item="next"></a>

				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<div class="uk-section uk-section-secondary jp-sitemap">
		<div class="uk-container uk-container-small">
			<div uk-grid>
				<div class="uk-width-1-3@s uk-width-1-2">
					<?php if (has_nav_menu('left-footer')): ?>
						<?php
						$locations = get_nav_menu_locations();
						$menu_id = $locations[ "left-footer" ] ;
						$menu = wp_get_nav_menu_object($menu_id);
						?>
						<aside class="jp-aside-footer">

							<h4 class="ui header"><?= $menu->name ?></h4>
							<?php
							wp_nav_menu( [
								'menu_class' => "uk-list",
								'theme_location' => 'left-footer',
								'container_class' => 'aside-content',
								'container' => 'div'
							] );
							?>
						</aside>
					<?php endif; ?>
				</div>
				<div class="uk-width-1-3@s uk-width-1-2">
					<?php if (has_nav_menu('middle-footer')): ?>
						<?php
						$locations = get_nav_menu_locations();
						$menu_id = $locations[ "middle-footer" ] ;
						$menu = wp_get_nav_menu_object($menu_id);
						?>
					<aside class="jp-aside-footer">

						<h4 class="ui header"><?= $menu->name ?></h4>
						<?php
						wp_nav_menu( [
							'menu_class' => "uk-list",
							'theme_location' => 'middle-footer',
							'container_class' => 'aside-content',
							'container' => 'div'
						] );
						?>
					</aside>
					<?php endif; ?>
				</div>
				<div class="uk-width-1-3@s uk-width-1-2">
					<aside class="jp-aside-footer">
						<h4 class="ui header">SUIVRE JP MOTORS</h4>
						<div class="aside-content">
							<p></p>
						</div>
					</aside>
				</div>
			</div>
		</div>
	</div>

</footer>

<style type="text/css">

</style>
<?php wp_footer(); ?>

</body>

</html>
