<?php
/**
 * The site-map.php template file.
 * Template Name: Site Map
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Heisenberg
 */

get_header(); ?>

	<div class="row">

		<div class="hide-for-small-only medium-2 medium-offset-1 ">
			<?php do_action( 'did_displays_menu' ); ?>
		</div>
		<div class="small-10 small-offset-1 small-push-1 medium-7 medium-offset-1 medium-push-1 container">

			<div class="row"><br>

				<h1 style="margin-top:10px"><?php the_title(); ?></h1><br><br>
			</div>
			<div class="row">
				<div class="medium-4">
					<div class="sitemap-page-nav">
						<?php wp_nav_menu(
							array(
								'theme_location' => 'primary'
							)
						); ?>
					</div>
				</div>
				<?php do_action( 'did_show_displays_sitemap' ) ?>
			</div>
		</div>
	</div>
<?php
get_footer();
