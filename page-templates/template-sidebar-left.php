<?php
/**
 * Template Name: Sidebar Left
 * The template for displaying a page with the sidebar on the left side.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Heisenberg
 */

get_header(); ?>

<div class="row">
	<div class="medium-4 ">

		<?php get_sidebar(); ?>

	</div>
	<div class="medium-8">
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'page' ); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // End of the loop. ?>

			</main>
			<!-- #main -->
		</div>
		<!-- #primary -->

	</div>


</div><!-- .row -->

<?php get_footer(); ?>
