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

		<div class="hide-for-small-only medium-2 medium-offset-1 ">
			<?php do_action( 'did_displays_menu' ); ?>

			<a class="twitter-timeline" data-height="750" data-width="200" data-limit=5" data-border-color="#fff" data-dnt="true" data-border-color="#146BAB" href="https://twitter.com/Display_Innov" data-related="twitterapi,twitter">Tweets
				by Display_Innov</a>
			<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

		</div>
		<div class="small-10 small-offset-1 small-push-1 medium-7 medium-offset-1 medium-push-1 container">
			<div class="row">
				<?php do_action( 'did_display_icons' ); ?>
			</div>


		</div>
	</div>
</div>
<?php
get_footer();
