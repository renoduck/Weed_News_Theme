<?php
/**
 * The template part for displaying header text
 *
 * Display site title and site description.
 *
 * @package Suri
 * @since 0.0.6
 */

?>

<div<?php suri_attr( 'title-area' )?>>

	<?php $description = get_bloginfo( 'description', 'display' );?>

	<?php if ( $description || is_customize_preview() ) :?>
		<p<?php suri_attr( 'site-description' )?>>
			<?php echo $description; // WPCS :XSS ok.?>
		</p>
	<?php endif;?>

</div><!-- .title-area -->
