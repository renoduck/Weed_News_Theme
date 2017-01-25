<?php
/**
 * The template part for displaying an author biography
 *
 * This file incorporates code from Twenty Fifteen WordPress Theme,
 * Copyright 2014-2016 WordPress.org & Automattic.com Twenty Fifteen is
 * distributed under the terms of the GNU GPL.
 *
 * @package Suri
 * @since 0.0.6
 */

?>

<div<?php suri_attr( 'author-info' ); ?>>

	<?php
	/**
	 * Filter author bio avatar size.
	 *
	 * @since 0.0.6
	 */
	$suri_author_avatar_size = apply_filters( 'suri_author_bio_avatar_size', 120 );
	echo get_avatar( get_the_author_meta( 'user_email' ), $suri_author_avatar_size );
	?>

	<h2<?php suri_attr( 'author-title' ); ?>><span class="screen-reader-text"><?php esc_html_e( 'Author', 'suri' ); ?></span><?php the_author(); ?></h2>

	<p<?php suri_attr( 'author-bio' ); ?>>
		<?php the_author_meta( 'description' ); ?>
		<p><a<?php suri_attr( 'author-link' ); ?> href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
			<?php printf( esc_html__( 'View all posts by %s', 'suri' ), get_the_author() ); ?>
		</a></p>
	</p><!-- .author-bio -->

</div><!-- .author-info -->
