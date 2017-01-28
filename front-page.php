<?php
/**
 * The front-page.php template file.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Heisenberg
 */

get_header(); ?>

	<div class="row bottom-blue">
		<div class="columns">
			<div class="flexbox-banner">

				<?php if ( get_theme_mod( 'di_default_banner' ) ) { ?>

					<img class="flexbox-banner-item" src="<?php echo get_theme_mod( 'di_default_banner' ); ?>"
					     width="978" height="198">

					<?php // add a fallback if the logo doesn't exist
				}; ?>
			</div>
		</div>
	</div>

	<div class="row">

		<div class="hide-for-small-only medium-2 medium-offset-1 ">
			<?php do_action( 'did_displays_menu' ); ?>
		</div>
		<div class="small-12 medium-7 medium-offset-1 medium-pull-1">
			<div class="flexbox-display-icons">
				<?php do_action( 'did_display_icons' ); ?>
			</div>
		</div>
	</div>

	<div class="hide-for-medium small-12 ">
		<div class="off-canvas position-left" id="offCanvas" data-off-canvas>
			<?php do_action( 'did_displays_menu' ); ?>
		</div>
	</div>

<?php
get_footer();
