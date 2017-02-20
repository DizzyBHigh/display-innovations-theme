<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Heisenberg
 */
?>

			</div><!-- #content -->

<footer id="colophon" class="top-blue site-footer" role="contentinfo">

	<div class="row">
		<div class="columns small-12 medium-2 medium-offset-2">
			<div class="footer-page-nav">
				<div class="di-no-underline">&nbsp;</div>
				<?php wp_nav_menu(
					array(
						'theme_location' => 'primary'
					)
				); ?>
			</div>
		</div>
		<div class="columns small-12 medium-4 ">
			<div class="flexbox-displays-menu">

				<div class="di-underline">Products</div>
				<?php do_action( 'did_show_displays_footer' ) ?>
			</div>
		</div>
		<div class="columns small-12 medium-2 medium-offset-1 ">
			<div class="di-underline">Contact</div>
						<span class="contact-text">DISPLAY INNOVATIONS<br>
						48 Charlotte Street<br>
						London<br>
						W1T 2NS<br>

						T: +44 (0) 203 178 4058
							</span>
		</div>
				</div><!-- .column.row -->
	<div class="row top-blue-thin">
		<div class="float-center">
			© 2012 All rights reserved. | Site updated: 09/02/2017 | <a href="/sitemap">Site Map</a> | <a href="/terms">Termsof
				Use</a>
		</div>
	</div>

			</footer><!-- #colophon -->

		</div> <!-- .off-canvas-content -->
	</div><!-- .off-canvas-wrapper-inner -->
</div><!-- .off-canvas-wrapper -->

<?php wp_footer(); ?>
</body>
</html>
