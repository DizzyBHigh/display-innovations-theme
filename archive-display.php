<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Heisenberg
 */

get_header(); ?>

<div class="row">
	<div class="medium-3 medium-offset-1">
		<?php do_action('did_displays_menu'); ?>
	</div>
	<div class="medium-1"></div>
	<div class="small-7 medium-7">
		<div class="flexbox-display-icons">
			<?php do_action('did_display_icons'); ?>
		</div>
	</div>
</div>


<?php
get_footer();
