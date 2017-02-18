<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Heisenberg
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php echo file_get_contents( get_template_directory() . '/assets/dist/sprite/sprite.svg' ); ?>

<div class="off-canvas-wrapper">
  <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
    <div class="title-bar show-for-small-only">
      <div class="title-bar-left">
        <button class="menu-icon" type="button" data-toggle="offCanvasLeft"></button>
        <span class="title-bar-title"><?php bloginfo( 'name' ); ?></span>
      </div>
    </div><!-- .title-bar -->
    <div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas>
			<button class="close-button" aria-label="Close menu" type="button" data-close>
				<span aria-hidden="true">&times;</span>
			</button>
			<?php
			 $args = array (
				 'theme_location' 	=> 'primary',
				 'container' 		=> 'nav',
				 'container_class'	=> 'offcanvas-navigation',
				 'menu_class' 			=> 'mobile-menu',
			 );
				wp_nav_menu( $args );
			?>
	    <?php do_action('did_displays_menu'); ?>
    </div><!-- #offCanvasLeft -->
    <div class="off-canvas-content" data-off-canvas-content>
	    <div data-sticky-container>
			<header id="masthead" class="" role="banner" data-sticky data-options="marginTop:0;" style="width:100%">
				<section class="row bottom-blue align-bottom">
					<div class="columns small-12 medium-4 medium-offset-2">
						<a href="<?php esc_attr_e( home_url( '/' ) ); ?>" rel="home">
							<?php the_custom_logo(); ?>
						</a>
					</div>
					<div class="columns small-12 medium-4">
						<div class="row align-right">
							<?php if ( get_theme_mod( 'di_social_twitter' ) ) { ?>
								<a class="di-social-icon"
								   href="http://twitter.com/<?php echo get_theme_mod( 'di_social_twitter' ) ?> ">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/dist/img/twitter.gif"/>
								</a>
							<?php }; ?>
							<?php if ( get_theme_mod( 'di_social_linkedin' ) ) { ?>
								<a class="di-social-icon"
								   href="http://uk.linkedin.com/in/<?php echo get_theme_mod( 'di_social_linkedin' ) ?>">
									<img
										src="<?php echo get_template_directory_uri(); ?>/assets/dist/img/linkedin.gif"/>
								</a>
							<?php }; ?>
							<?php if ( get_theme_mod( 'di_social_youtube' ) ) { ?>
								<a class="di-social-icon"
								   href="http://www.youtube.com/user/<?php echo get_theme_mod( 'di_social_youtube' ) ?>">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/dist/img/youtube.gif"/>
								</a>
							<?php }; ?>
						</div>
						<div class="row">
							<div class="main-navigation">
								<?php wp_nav_menu(
									array(
										'theme_location'  => 'primary',
										'container_class' => 'main-nav',

									)
								); ?>
							</div>
						</div>
					</div>
				</section>
				<nav id="site-navigation" class="top-bar show-for-medium" data-topbar role="navigation">
					<section class="top-bar-section row column">

					</section>
				</nav><!-- #site-navigation -->
			</header><!-- #masthead -->
		</div>
			<div id="content" class="site-content">
<?php do_action( 'did_show_banner' ); ?>