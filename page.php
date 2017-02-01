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

do_action( 'did_show_banner' );
?>


<div class="row">

	<div class="medium-8 columns">

		<div id="primary" class="content-area">

			<main id="main" class="site-main" role="main">
				<?php
				while ( have_posts() ) :

					the_post();

					get_template_part( 'template-parts/content', 'page' );

						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

				endwhile; ?>

			</main>

		</div>

	</div>

</div>

<?php
get_footer();
