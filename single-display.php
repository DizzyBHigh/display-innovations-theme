<?php
/**
 * The template for displaying a single display.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Heisenberg
 */

get_header();
?>
	<div class="row">
		<div class="hide-for-small-only medium-2 medium-offset-1 ">
			<?php do_action( 'did_displays_menu', get_post_meta( get_the_ID(), '_did_parent_menu', 1 ) ); ?>
		</div>
		<div class="small-10 small-offset-1 small-push-1 medium-7 medium-offset-1 medium-push-1">
			<div class="display-holder">
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="row">
						<div class="small-12 medium-12">
							<h1><?php the_title(); ?></h1>

							<?php do_action( 'did_show_case_studies', get_the_ID() ); ?>

						</div>
					</div>
					<div class="row">
						<div class="small-12 medium-12 container">
							<?php do_action( 'did_related_displays', get_the_ID(), 'top' ); ?>
						</div>
					</div>
					<div class="row">
						<div class="small-12 medium-12">

							<?php do_action( 'did_show_images', get_the_ID() ); ?>

						</div>
					</div>
					<div class="row">
						<div class="small-12 medium-12">
							<?php the_content(); ?>
						</div>
					</div>
					<div class="row">
						<div class="small-12 medium-12 container">
							<?php do_action( 'did_related_displays', get_the_ID(), 'bottom' ); ?>
						</div>
					</div>
					<?php do_action( 'did_show_applications', get_the_ID() ); ?>


					<?php do_action( 'did_show_technical', get_the_ID() ); ?>



				<?php endwhile; // End of the loop. ?>
			</div>
		</div>
	</div>
<?php
get_footer();