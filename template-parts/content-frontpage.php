<?php
/**
 * Template part for displaying posts on the front-page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gaetan_Masson_2019
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>
	<?php gaetan_masson_design_post_thumbnail(); ?>

	<div class="entry__content">

		<?php
		$post__type = get_field('post__type');
		if( $post__type ) : ?>

			<p class="entry__type"><?php echo $post__type; ?></P>

		<?php
		endif;

		the_title('<h2 class="entry__title">', '</h2>');
		
		$the_excerpt = get_the_excerpt();

		if( $the_excerpt ) :
		?>

			<p class="entry__excerpt"><?php echo $the_excerpt; ?></p>
		<?php
		endif;
		?>
		<a href="<?php the_permalink(); ?>">Read case study</a>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
