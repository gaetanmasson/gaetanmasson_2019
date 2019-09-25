<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Gaetan_Masson_2019
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gaetanmasson_2019' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="grid-container">
			<nav id="site-navigation" class="main-navigation">
				<div class="main-navigation__left">
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				</div>
				<div class="main-navigation__right">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<figure class="icon__menu"><?php echo file_get_contents( get_template_directory() . "/images/icon__menu.svg" ); ?></figure>
						<figure class="icon__close"><?php echo file_get_contents( get_template_directory() . "/images/icon__close.svg" ); ?></figure>
					</button>
					<?php
					wp_nav_menu( array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					) );
					?>
				</div>
			</nav><!-- #site-navigation -->
		</div>
		<div class="grid-container">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					$front_page_title = get_field( "front_page_title" );
					?>
					<h1 class="site-title"><?php echo ($front_page_title ? $front_page_title : 'Headline missing'); ?></h1>
					<?php
				elseif ( is_page('about') ) :
					$about_page_title = get_field( "about_page_title" );
					?>
					<h1 class="about-title"><?php echo ($about_page_title ? $about_page_title : 'Headline missing'); ?></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$gaetanmasson_2019_description = get_bloginfo( 'description', 'display' );
				if ( $gaetanmasson_2019_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $gaetanmasson_2019_description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
