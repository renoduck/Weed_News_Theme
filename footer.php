<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Suri
 * @since 0.0.1
 */

?>
		
		</div><!-- #content -->

		<?php
		/**
		 * Fires immediately before site footer area.
		 *
		 * @since 0.0.1
		 */
		do_action( 'suri_hook_before_footer' ); ?>

		<footer id="colophon" <?php suri_attr( 'site-footer' ); ?>>

			<?php
			/**
			 * Fires immediately after opening site footer tag.
			 *
			 * @since 0.0.1
			 */
			do_action( 'suri_hook_for_footer_items' );?>

		</footer><!-- #colophon -->

		<?php
		/**
		 * Fires immediately after site footer area.
		 *
		 * @since 0.0.1
		 */
		do_action( 'suri_hook_after_footer' );?>

		</div><!-- #page -->
		<?php wp_footer(); ?>
		<!-- W3TC-include-css -->
		</body>
</html>
