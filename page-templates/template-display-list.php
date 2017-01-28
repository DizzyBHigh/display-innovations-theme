<?php
/**
 * Template Name: Display List Left
 * The template for displaying a page with the sidebar on the left side.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Heisenberg
 */

get_header(); ?>

	<div class="row bottom-blue">
		<div class="columns">
			<div class="flexbox-banner">

				<?php if ( get_theme_mod( 'di_default_banner' ) ) { ?>

					<img class="flexbox-banner-item" src="<?php echo get_theme_mod( 'di_default_banner' ); ?>" width="978" height="198">

					<?php // add a fallback if the logo doesn't exist
				}; ?>
			</div>
		</div>
	</div>

	<div class="row">

		<div class="small-12 medium-2 medium-offset-1 ">
			<?php do_action('did_displays_menu'); ?>
		</div>
		<div class="small-12 medium-7 medium-offset-1 medium-pull-1">
			<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

			<?php endwhile; // End of the loop. ?>
		</div>
	</div>

<?php
get_footer();
