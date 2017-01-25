<?php
/**
 * Filters to modify default contents
 *
 * @package Suri
 * @since 0.0.7
 */

/**
 * Filters to add or change theme contents.
 *
 * @since 0.0.7
 */
class Suri_Filters {

	/**
	 * Constructor method intentionally left blank.
	 *
	 * @since 0.0.7
	 */
	private function __construct() {}

	/**
	 * Initiate.
	 *
	 * @since 0.0.7
	 */
	public static function initiate() {
		add_filter( 'body_class'                         , array( __CLASS__, 'add_body_classes' ) );
		add_filter( 'suri_get_attr_header-menu'          , array( __CLASS__, 'add_header_menu_classes' ) );
		add_filter( 'excerpt_length'                     , array( __CLASS__, 'change_excerpt_length' ) );
		add_filter( 'excerpt_more'                       , array( __CLASS__, 'modify_excerpt_teaser' ) );
		add_filter( 'suri_get_attr_footer-widgets'       , array( __CLASS__, 'count_active_footer_widgets' ) );
		add_filter( 'widget_nav_menu_args'               , array( __CLASS__, 'social_nav_menu_widget' ), 10, 4 );
		add_filter( 'wp_get_attachment_image_attributes' , array( __CLASS__, 'custom_logo_attr' ), 10, 2 );
	}

	/**
	 * Adds custom classes to the array of body class.
	 *
	 * @since 0.0.7
	 *
	 * @param array $classes Classes for the body element.
	 * @return array
	 */
	public static function add_body_classes( $classes ) {

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) :
			$classes[] = 'group-blog';
		endif;

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) :
			$classes[] = 'hfeed';
		endif;

		// Adds a class for content sidebar alignment.
		if ( ! self::is_sidebar() ) :
			$classes[] = 'only-content';
		elseif ( 'sidebar-content' === get_theme_mod( 'suri_layout', suri_get_theme_defaults( 'suri_layout' ) ) ) :
			$classes[] = 'sidebar-content';
		else :
			$classes[] = 'content-sidebar';
		endif;

		// Adds a class for header content alignment.
		if ( 'content-align' === get_theme_mod( 'suri_header_layout', suri_get_theme_defaults( 'suri_header_layout' ) ) ) :
			$classes[] = 'branding-wrapper';
		endif;

		// Adds a class to identify excerpt or full content on home, search or archive pages.
		if ( is_home() || is_search() || is_archive() ) :
			if ( 'excerpt' === get_theme_mod( 'suri_excerpt_option', suri_get_theme_defaults( 'suri_excerpt_option' ) ) ) :
				$classes[] = 'excerpt';
			else :
				$classes[] = 'full-content';
			endif;
		endif;

		return $classes;
	}

	/**
	 * Adds custom classes to header menu.
	 *
	 * @since 0.1.0
	 *
	 * @param array $attr attribute values array.
	 * @return array
	 */
	public static function add_header_menu_classes( $attr ) {
		// Adds a class for header menu content alignment.
		if ( 'content-align' === get_theme_mod( 'suri_header_layout', suri_get_theme_defaults( 'suri_header_layout' ) ) ) :
			$attr['class'] .= ' aligned-menu';
		endif;

		return $attr;
	}

	/**
	 * Active footer widets counter.
	 *
	 * Count number of active footer widets and accordingly add a class to
	 * footer-widgets tag.
	 *
	 * @since 0.1.0
	 *
	 * @param array $attr attribute values array.
	 * @return array
	 */
	public static function count_active_footer_widgets( $attr ) {
		$total = 0;
		$i = 0;
		while ( $i < 3 ) {
			$i++;
			if ( is_active_sidebar( 'footer-' . $i ) ) :
				$total++ ;
			endif;
		}

		if ( 1 === $total ) :
			$class = 'oafw'; // One active footer widget.
			$attr['class'] .= sprintf( ' %s', $class );
		elseif ( 2 === $total ) :
			$class = 'tafw'; // Two active footer widgets.
			$attr['class'] .= sprintf( ' %s', $class );
		endif;

		return $attr;
	}

	/**
	 * Change excerpt length.
	 *
	 * Change excerpt length to be displayed on main, archive and search
	 * pages, default excerpt length is 55.
	 *
	 * @since 0.0.7
	 *
	 * @param int $length excert length.
	 * @return integer
	 */
	public static function change_excerpt_length( $length ) {
		$length = absint( get_theme_mod( 'suri_excerpt_length', suri_get_theme_defaults( 'suri_excerpt_length' ) ) );
		return $length;
	}

	/**
	 * Change Read more text.
	 *
	 * Change excerpt read more link text based on custom text entered in
	 * theme customizer.
	 *
	 * @since 0.0.7
	 *
	 * @return string
	 */
	public static function modify_excerpt_teaser() {
		$url  = esc_url( get_permalink() );
		$text = esc_html( get_theme_mod( 'suri_excerpt_teaser', suri_get_theme_defaults( 'suri_excerpt_teaser' ) ) );
		$title = get_the_title();

		if ( 0 === strlen( $title ) ) :
			$screen_reader = '';
		else :
			$screen_reader = sprintf( '<span class="screen-reader-text">%s</span>', $title );
		endif;

		$excerpt_teaser = sprintf( '<a  class="more-link" href="%1$s">%2$s %3$s</a>', $url, $text, $screen_reader );
		return $excerpt_teaser;
	}

	/**
	 * Check if sidebar is to be displaed or not.
	 *
	 * @since 0.0.8
	 *
	 * @see Suri_Filters::add_body_classes()
	 *
	 * @return (int|bool) True if sidebar to be displayed, False if not.
	 */
	public static function is_sidebar() {
		if ( ! is_active_sidebar( 'sidebar-1' ) ) :
			return false;
		endif;

		if ( 'only-content' === get_theme_mod( 'suri_layout', suri_get_theme_defaults( 'suri_layout' ) ) ) :
			return false;
		endif;

		if ( ( is_home() || is_front_page() ) && '' !== get_theme_mod( 'suri_hide_sidebar_on_home', suri_get_theme_defaults( 'suri_hide_sidebar_on_home' ) ) ) :
			return false;
		endif;

		return true;
	}

	/**
	 * Check for social menu in class-wp-nav-menu-widget.
	 *
	 * Check for social menu in widget and return appropriate social nav menu args.
	 *
	 * @since 0.1.2
	 *
	 * @param array    $nav_menu_args {
	 *     An array of arguments passed to wp_nav_menu() to retrieve a custom menu.
	 *
	 *     @type callable|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
	 *     @type mixed         $menu        Menu ID, slug, or name.
	 * }
	 * @param stdClass $nav_menu      Nav menu object for the current menu.
	 * @param array    $args          Display arguments for the current widget.
	 * @param array    $instance      Array of settings for the current widget.
	 * @return array $nav_menu_args.
	 */
	public static function social_nav_menu_widget( $nav_menu_args, $nav_menu, $args, $instance ) {
		$social_menu = '';
		$menu_arr = get_nav_menu_locations();
		if ( isset( $menu_arr['social'] ) ) :
			$social_menu = $menu_arr['social'];
		else :
			return $nav_menu_args;
		endif;

		if ( current_theme_supports( 'suri_genericons' ) ) :
			$link_before = '<span class="screen-reader-text" itemprop="name">';
		else :
			$link_before = '<span itemprop="name">';
		endif;

		if ( $social_menu === $instance['nav_menu'] ) :
			$nav_menu_args = array(
				'depth'          => 1,
				'theme_location' => 'social',
				'menu_id'        => 'social-nav',
				'menu_class'     => 'nav-menu social-icons-menu',
				'container'      => false,
				'link_before'    => $link_before,
				'link_after'     => '</span>',
				'items_wrap'     => '<nav id="social-menu" role="navigation" aria-label="Social Menu"' . suri_get_attr( 'social-menu' ) . '><ul id="%1$s" class="%2$s">%3$s</ul></nav>',
			);
		endif;

		return $nav_menu_args;
	}

	/**
	 * Modify custom logo attributes.
	 *
	 * Modify 'itemprop="logo"' and 'alt' attributes to address google strucutral data
	 * and accessibility related errors.
	 *
	 * @since 0.1.9
	 *
	 * @param array   $attr       Attributes for the image markup.
	 * @param WP_Post $attachment Image attachment post.
	 * @return array
	 */
	public static function custom_logo_attr( $attr, $attachment ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		if ( $custom_logo_id === $attachment->ID ) :
			if ( isset( $attr['itemprop'] ) ) :
				unset( $attr['itemprop'] );
			endif;
			if ( ! get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ) ) :
				$attr['alt'] = get_bloginfo( 'name', 'display' );
			endif;
		endif;

		return $attr;
	}
}

Suri_Filters::initiate();
