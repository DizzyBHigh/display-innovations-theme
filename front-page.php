<?php
/**
 * The front-page.php template file.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Heisenberg
 */

get_header(); ?>
	<div class="row">

		<div class="small-10 small-offset-1 medium-3 medium-offset-1 large-3 large-offset-1">
			<?php do_action( 'did_displays_menu' ); ?>
			<br><br>
			<div class="di-border">
				<a class="twitter-timeline" data-height="600" data-dnt="true" href="https://twitter.com/Display_Innov">Tweets
					by Display_Innov</a>
				<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
		</div>
		</div>
		<div class="small-10 small-offset-1 medium-6 medium-offset-1 large-6 large-offset-1">
			<div class="container">
				<?php do_action( 'did_display_icons' ); ?>
			</div>
		</div>
		<div class="small-1 medium-1 large-1"></div>
	</div>

<?php
get_footer();
