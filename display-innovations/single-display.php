<?php
/**
 * The template for displaying a single display.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Heisenberg
 */

get_header(); ?>

	<div class="row bottom-blue">
		<div class="columns">
			<div class="flexbox-banner">
				<?php
				global $post;
				$banner = get_post_meta( $post->ID, '_did_banner' );
				?>
				<img class="flexbox-banner-item" src="<?php echo $banner[0]; ?>" width="978" height="198">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="hide-for-small-only medium-2 medium-offset-1 ">
			<?php do_action( 'did_displays_menu' ); ?>
		</div>
		<div class="small-10 small-offset-1 small-push-1 medium-7 medium-offset-1 medium-pull-1">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content-display' ); ?>

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