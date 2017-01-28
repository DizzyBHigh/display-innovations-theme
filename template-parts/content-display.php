<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Heisenberg
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
			'</a></h2>' ); ?>
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php heisenberg_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header>
	<!-- .entry-header -->

	<div class="entry-content">
		<?php do_action( 'did_show_case_studies', get_the_ID() ); ?>

		<div class="flexbox-display-icons">
			<?php do_action( 'did_show_images', get_the_ID() ); ?>
		</div>
		<?php
		/* translators: %s: Name of current post */
		the_content( sprintf(
		/* translators: %s: Name of current post. */
			wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'display-innovations' ),
				array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		) );
		?>


	</div>
	<!-- .entry-content -->

	<footer class="entry-footer">
		<?php heisenberg_entry_footer(); ?>
	</footer>
	<!-- .entry-footer -->
</article><!-- #post-## -->
