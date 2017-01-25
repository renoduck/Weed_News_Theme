<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package suri
 * @since 0.0.1
 */

get_header(); ?>
<h1 class="entry-title" itemprop="headline" style="display: none;">Weed News | Marijuana News, Policy, Culture and Law</h1>

	<div id="primary"<?php suri_attr( 'content-area' ); ?>>

		<?php
		/**
		 * Fires immediately after opening of primary content area.
		 *
		 * @since 0.0.1
		 */
		do_action( 'suri_hook_before_main_content' ); ?>

		<main id="main" <?php suri_attr( 'site-main' ); ?>>

			<?php
			if ( have_posts() ) :
				if ( is_home() && ! is_front_page() ) :?>

					<header<?php suri_attr( 'page-header' ); ?>>
						<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
					</header><!-- .page-header -->

				<?php
				endif;

				/**
				 * Fires immediately before executing main loop.
				 *
				 * @since 0.0.1
				 */
				do_action( 'suri_hook_before_content_while' );

				while ( have_posts() ) : the_post();

					/**
					 * Include the Post-Format-specific template for the content.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				endwhile;

				/**
				 * Fires immediately after executing main loop.
				 *
				 * @since 0.0.1
				 */
				do_action( 'suri_hook_after_content_while' );

			else :

				/**
				 * Include template if no content is available.
				 */
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>

		</main><!-- #main -->

		<?php
		/**
		 * Fires immediately before closing primary content area.
		 *
		 * @since 0.0.1
		 */
		do_action( 'suri_hook_after_main_content' ); ?>

	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
