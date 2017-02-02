<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Heisenberg
 */

get_header();

do_action( 'did_show_banner' ) ?>



	<div class="row">
		<div class="hide-for-small-only medium-2 medium-offset-1 ">
			<?php do_action( 'did_displays_menu' ); ?>
		</div>
		<div class="small-10 small-offset-1 small-push-1 medium-7 medium-offset-1 medium-push-1">

			<?php while ( have_posts() ) : the_post(); ?>

				<div class="row">
					<div class="small-12 medium-12">
						<h2><?php the_title(); ?></h2>
						<?php the_content(); ?>
					</div>
				</div>

			<?php endwhile; // End of the loop. ?>
		</div>
		<div class="show-for-small-only small-offset-1 small-10 small-push-1">
			<?php do_action( 'did_displays_menu' ); ?>
		</div>
	</div>
<?php
get_footer();