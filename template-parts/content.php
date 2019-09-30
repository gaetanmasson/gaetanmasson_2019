<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gaetan_Masson_2019
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<header class="entry__header">

	<?php 
	$post__logo = get_field('post__logo');

	if( !empty($post__logo) ): ?>

		<figure class="entry__logo">
			<img src="<?php echo $post__logo['url']; ?>" alt="<?php echo $post__logo['alt']; ?>" />
		</figure>

	<?php endif;
	
	$post__type = get_field( 'post__type' );

	if( !empty($post__type) ) : ?>

		<p class="entry__type"><?php echo $post__type; ?></P>

	<?php endif;

	the_title( '<h1 class="entry__title">', '</h1>' );
	
	$the_excerpt = get_the_excerpt();

	if( !empty($the_excerpt) ) : ?>

		<p class="entry__excerpt"><?php echo $the_excerpt; ?></p>

	<?php endif; ?>

	</header><!-- .entry-header -->
	<div class="entry__role-container">
		<div class="entry__role">

			<?php
			$post__role = get_field('post__role');

			if( $post__role ):
			?>

			<h2>My role</h2>
			<p><?php echo $post__role; ?></p>

			<?php 
			endif;
			?>
		</div>
	</div>
	<div class="entry__content-container">
		<div class="entry__content">

			<?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'gaetanmasson_2019' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gaetanmasson_2019' ),
				'after'  => '</div>',
			) );
			?>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
