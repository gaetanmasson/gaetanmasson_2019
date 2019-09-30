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
		<nav id="site-navigation" class="main-navigation">
			<div class="main-navigation__left">
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			</div>
			<div class="main-navigation__right">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<figure class="icon__menu"><?php echo file_get_contents( get_template_directory() . "/assets/images/icon__menu.svg" ); ?></figure>
					<figure class="icon__close"><?php echo file_get_contents( get_template_directory() . "/assets/images/icon__close.svg" ); ?></figure>
				</button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
			</div>
		</nav><!-- #site-navigation -->
		<?php
		if ( is_front_page() && is_home() ) :
		?>
			<div class="site-branding">
			<?php
				$frontpage__title =  get_field('frontpage__title', 'option');
				$frontpage__tagline = get_field('frontpage__tagline', 'option');
				$frontpage__tagline_link = get_field('frontpage__tagline-link', 'option');
				
				if ( $frontpage__tagline_link ) {
					$frontpage__tagline_link_url = $frontpage__tagline_link['url'];
					$frontpage__tagline_link_title = $frontpage__tagline_link['title'];
					$frontpage__tagline_link_target = $frontpage__tagline_link['target'] ? $frontpage__tagline_link['target'] : '_self';
				}
				?>
					<?php
					if ( $frontpage__title ) :
					?>
						<h1 class="frontpage__title"><?php echo $frontpage__title; ?></h1>
					<?php
					else :
					?>
						<h1 class="frontpage__title"><?php echo "Title is missing"; ?></h1>
					<?php
					endif;

					if ( $frontpage__tagline ) :
					?>
						<p class="frontpage__tagline"><?php echo $frontpage__tagline . " "; ?>
							<?php
							if ($frontpage__tagline_link) :
							?>
								<a class="button" href="<?php echo esc_url($frontpage__tagline_link_url); ?>" target="<?php echo esc_attr($frontpage__tagline_link_target); ?>"><?php echo esc_html($frontpage__tagline_link_title); ?></a>
							<?php
							endif;
							?>
						</p>
					<?php
					else :
					?>
						<p class="frontpage__tagline"><?php echo "Tagline is missing"; ?></p>
				<?php
				endif;
				?>
			</div><!-- .site-branding -->
		<?php
		endif;
		?>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
