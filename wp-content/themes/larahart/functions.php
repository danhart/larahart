<?php
/**
 * Lara_Hart functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package Lara_Hart
 * @since Lara_Hart 0.1
 */

// require_once ( get_template_directory() . '/theme-options.php' );
// require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( ! function_exists( 'larahart_setup' ) ):
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which runs
   * before the init hook. The init hook is too late for some features, such as indicating
   * support post thumbnails.
   *
   * To override larahart_setup() in a child theme, add your own larahart_setup to your child theme's
   * functions.php file.
   */
  function larahart_setup() {
    /**
     * Add default posts and comments RSS feed links to head
     */
    add_theme_support( 'automatic-feed-links' );

    /**
     * This theme uses wp_nav_menu() in one location.
     */
    register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'larahart' ),
    ) );

    /**
     * Add support for the Aside and Gallery Post Formats
     */
    // add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery' ) );

    /**
     * Add support for featured image in posts and pages
     */
    add_theme_support( 'post-thumbnails' );

    /**
     * Add a custom image sizes
     */
    add_image_size( 'aside-image', 185, 327, true ); 
  }
endif; // larahart_setup

/**
 * Tell WordPress to run larahart_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'larahart_setup' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function larahart_page_menu_args( $args ) {
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'larahart_page_menu_args' );

if ( ! function_exists( 'larahart_google_analytics' ) ) :
  /**
   * Includes Google Analytics Code
   *
   * @since Lara_Hart 0.1
   */
  function larahart_google_analytics() {

    $options = get_option( 'larahart_theme_options' );
    if (!$options['googleanalyticsenabled']) return;
?>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-16885417-1']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
<?php
  }
endif;

add_action('wp_head', 'larahart_google_analytics');

/**
 * Change the currently active page class
 */
add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);
function special_nav_class($classes, $item){
  if($item->current) $classes[] = "active";
  return $classes;
}

if ( ! function_exists( 'body_id' ) ) :
  /**
   * Adds a body ID dependant on which page or page type is
   * currently being viewed
   *
   * @since Build_A_Business 1.0
   */
  function body_id() {
    if (is_page()) {
      $id = get_query_var('name');
    } elseif (is_single()) {
      $id = 'single';
    } elseif (is_category()) {
      $id = single_cat_title();
    } elseif (is_archive()) {
      $id = 'archive';
    } elseif (is_home()) {
      $id = 'updates';
    } else {
      $id = '';
    }

    echo 'id="' . $id . '"';
  }
endif;
