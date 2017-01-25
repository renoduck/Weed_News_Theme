<?php
/**
 * The template part for displaying header meta information for current post
 *
 * @package Suri
 * @since 0.0.6
 */

?>

<div<?php suri_attr( 'entry-meta' ) ?>>
	<span<?php suri_attr( 'byline' ) ?>>
		<span<?php suri_attr( 'author vcard' ) ?>>
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"<?php suri_attr( 'url fn' ) ?>>
				<span<?php suri_attr( 'name' ) ?>> <?php the_author(); ?></span>
			</a>
		</span>
	</span>

	<span<?php suri_attr( 'posted-on' ) ?>>
		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<?php if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) :?>
				<time datetime="<?php the_modified_date( 'c' ) ?>"<?php suri_attr( 'modified-entry-date date updated' )?>>
					<?php the_modified_date( 'F j, Y, g:i a' ); ?>
				</time>
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ) ?>"<?php suri_attr( 'entry-date date updated' )?>>
					<?php echo esc_html( get_the_date( 'F j, Y, g:i a' ) ); ?>
				</time>
			<?php else : ?>
				<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ) ?>"<?php suri_attr( 'entry-date date updated' )?>>
					<?php echo esc_html( get_the_date( 'F j, Y, g:i a' ) ); ?>
				</time>
			<?php endif;?>
		</a>
	</span>

	<?php edit_post_link( esc_html__( 'Edit', 'suri' ), '<span' . suri_get_attr( 'edit-link' ) . ' >', '</span>' );?>
</div>
