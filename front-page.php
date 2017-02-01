<?php
/**
 * The front-page.php template file.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Heisenberg
 */

get_header(); ?>


<?php do_action( 'did_show_banner' ); ?>



	<div class="row">

		<div class="hide-for-small-only medium-2 medium-offset-1 ">
			<?php do_action('did_displays_menu'); ?>
		</div>
		<div class="small-12 medium-7 medium-offset-1 medium-pull-1">
			<div class="flexbox-display-icons">
				<?php do_action('did_display_icons'); ?>
			</div>
		</div>
	</div>

		<div class="hide-for-medium small-12 ">
			<div class="off-canvas position-left" id="offCanvas" data-off-canvas>
			<?php do_action('did_displays_menu'); ?>
		</div>
			</div>

<?php
get_footer();
