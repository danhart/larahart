<?php
/**
 * Change_Me functions and definitions
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
 * @package Change_Me
 * @since Change_Me 0.1
 */

// require_once ( get_template_directory() . '/theme-options.php' );
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( ! function_exists( 'changeme_setup' ) ):
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which runs
   * before the init hook. The init hook is too late for some features, such as indicating
   * support post thumbnails.
   *
   * To override changeme_setup() in a child theme, add your own changeme_setup to your child theme's
   * functions.php file.
   */
  function changeme_setup() {
    /**
     * Make theme available for translation
     * Translations can be filed in the /languages/ directory
     */
    load_theme_textdomain( 'changeme', get_template_directory() . '/languages' );

    $locale = get_locale();
    $locale_file = get_template_directory() . "/languages/$locale.php";
    if ( is_readable( $locale_file ) )
      require_once( $locale_file );

    /**
     * Add default posts and comments RSS feed links to head
     */
    add_theme_support( 'automatic-feed-links' );

    /**
     * This theme uses wp_nav_menu() in one location.
     */
    register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'changeme' ),
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
    // add_image_size( 'medium-featured-image', 200, 200, true ); 
  }
endif; // changeme_setup

/**
 * Tell WordPress to run changeme_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'changeme_setup' );

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function changeme_page_menu_args( $args ) {
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'changeme_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function changeme_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Sidebar 1', 'changeme' ),
    'id' => 'sidebar-1',
    'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="container">',
    'after_widget' => "</div></aside>",
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>',
  ) );

  register_sidebar( array(
    'name' => __( 'Footer', 'changeme' ),
    'id' => 'sidebar-2',
    'description' => __( 'Footer widget area', 'changeme' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ) );
}
add_action( 'init', 'changeme_widgets_init' );

if ( ! function_exists( 'changeme_content_nav' ) ):
  /**
   * Display navigation to next/previous pages when applicable
   *
   * @since Change_Me 0.1
   */
  function changeme_content_nav( $nav_id ) {
    global $wp_query;
    ?>

      <?php if ( is_single() ) : // navigation links for single posts ?>

        <nav class="<?php echo $nav_id; ?>">
          <h1 class="assistive-text section-heading"><?php _e( 'Post navigation', 'changeme' ); ?></h1>

        <?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="prev">&lt;</span>' . __( '<span>PREV ARTICLE</span>', 'changeme' ) ); ?>
        <?php next_post_link( '<div class="nav-next">%link</div>', '<span class="next">&gt;</span>' . __( '<span>NEXT ARTICLE</span>', 'changeme' ) ); ?>

        </nav><!-- #<?php echo $nav_id; ?> -->

      <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

        <nav class="<?php echo $nav_id; ?>">
          <h1 class="assistive-text section-heading"><?php _e( 'Post navigation', 'changeme' ); ?></h1>
        <?php

        echo paginate_links(array(
          'format' => '?paged=%#%',
          'current' => max( 1, get_query_var('paged') ),
          'total' => $wp_query->max_num_pages,
          'type'       => 'list',
          'prev_next'  => True,
          'mid_size'   => 1,
          'end_size'   => 2,
          'prev_text'  => __('&lt;'),
          'next_text'  => __('&gt;'),
        ));

        ?>

        </nav><!-- #<?php echo $nav_id; ?> -->

      <?php endif; ?>

    <?php
  }
endif; // changeme_content_nav


if ( ! function_exists( 'changeme_comment' ) ) :
  /**
   * Template for comments and pingbacks.
   *
   * To override this walker in a child theme without modifying the comments template
   * simply create your own changeme_comment(), and that function will be used instead.
   *
   * Used as a callback by wp_list_comments() for displaying the comments.
   *
   * @since Change_Me 0.1
   */
  function changeme_comment( $comment, $args, $depth ) {
    $args['reply_text'] = '&gt;&gt; reply';
    $GLOBALS['comment'] = $comment;
    $avatarSize = 63;
    switch ( $comment->comment_type ) :
      case 'pingback' :
      case 'trackback' :
    ?>
    <li class="post pingback">
      <p><?php _e( 'Pingback:', 'changeme' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'changeme' ), ' ' ); ?></p>
    <?php
        break;
      default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
      <article id="comment-<?php comment_ID(); ?>" class="comment">
        <footer>
          <div class="comment-author vcard">
            <?php echo get_avatar( $comment, $avatarSize ); ?>
          </div><!-- .comment-author .vcard -->
          <div class="reply">
            <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
          </div><!-- .reply -->
        </footer>

        <div class="comment-content">
          <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="moderation"><?php _e( 'Your comment is awaiting moderation.', 'changeme' ); ?></em>
            <br />
          <?php endif; ?>

          <div class="comment-meta commentmetadata">
            <?php printf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ?>
            <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
            <?php
              /* translators: 1: date, 2: time */
              printf( __( '%1$s %2$s', 'changeme' ), get_comment_date('F jS, Y'), get_comment_time() ); ?>
            </time></a>
            <?php edit_comment_link( __( '(Edit)', 'changeme' ), ' ' );
            ?>
          </div><!-- .comment-meta .commentmetadata -->

          <?php comment_text(); ?></div>

      </article><!-- #comment-## -->

    <?php
        break;
    endswitch;
  }
endif; // ends check for changeme_comment()

if ( ! function_exists( 'changeme_posted_on' ) ) :
  /**
   * Prints HTML with meta information for the current post-date/time and author.
   * Create your own changeme_posted_on to override in a child theme
   *
   * @since Change_Me 0.1
   */
  function changeme_posted_on() {
    printf( __( '<span class="byline"><span class="sep">Posted by </span> <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span></span><span class="sep"> on </span><a href="%4$s" title="%5$s" rel="bookmark"><time class="entry-date" datetime="%6$s" pubdate>%7$s</time></a>', 'changeme' ),
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
      esc_attr( sprintf( __( 'View all posts by %s', 'changeme' ), get_the_author() ) ),
      esc_html( get_the_author() ),
      esc_url( get_permalink() ),
      esc_attr( get_the_time() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date('M j, Y') )
    );
  }
endif;

if ( ! function_exists( 'changeme_social_media' ) ) :
  /**
   * Prints social media button HTML.
   *
   * @since Change_Me 0.1
   */
  function changeme_social_media($display_type = 'block') {
    $featuredImage = wp_get_attachment_image_src( get_post_thumbnail_id ( get_the_ID() ), "large-featured-image");
    $options = get_option( 'changeme_theme_options' );
    if ($options['socialmediaenabled']):
    ?>
    <div class="social-media <?php echo $display_type ?>">
      <div class="gplusone">
        <g:plusone href="<?php echo get_permalink(); ?>" size="medium" width="4"></g:plusone>
      </div>

      <div class="twitter-share">
        <a href="https://twitter.com/share" data-url="<?php echo get_permalink(); ?>" data-text="<?php printf( esc_attr__( '%s', 'changeme' ), the_title_attribute( 'echo=0' ) ); ?>" class="twitter-share-button">Tweet</a>
      </div>

      <![if !lte IE 6]>
      <div id="fb-root"></div>
      <div class="facebook-like">
        <fb:like href="<?php echo get_permalink(); ?>" send="true" layout="button_count" width="4" show_faces="false"></fb:like>
      </div>
      <![endif]>

      <?php if (has_post_thumbnail()): ?>
      <div class="pin-it">
      <a href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_permalink()) ?>&description=<?php echo urlencode(the_title_attribute( 'echo=0' )) ?>&media=<?php echo urlencode($featuredImage[0]) ?>" class="pin-it-button" count-layout="horizontal">Pin It</a>
      </div>
      <?php endif; ?>
    </div>
    <?php
    endif;
  }
endif;

if ( ! function_exists( 'changeme_google_analytics' ) ) :
  /**
   * Includes Google Analytics Code
   *
   * @since Change_Me 0.1
   */
  function changeme_google_analytics() {

    $options = get_option( 'changeme_theme_options' );
    if (!$options['googleanalyticsenabled']) return;
?>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-431126-3']);
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

add_action('wp_head', 'changeme_google_analytics');

/**
 * Filter in a class for the last post in a query
 */
function changeme_last_post_class($classes){
  global $wp_query;

  if(($wp_query->current_post+1) == $wp_query->post_count) $classes[] = 'last';
  return $classes;
}
add_filter('post_class', 'changeme_last_post_class');

/**
 * Filter to remove Website from the comments form fields
 */
function changeme_format_comments_form_fields() {
  $commenter = wp_get_current_commenter();
  $req = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );
  $val =  array(
    'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' . 
                '<label for="author">' . __( 'Name' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label></p>',
    'email'  => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' . 
                '<label for="email">' . __( 'MAIL <small>(Will not be published)</small> ' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label></p>',
    'url'    => ''
  );
  return $val;
}
add_filter('comment_form_default_fields', 'changeme_format_comments_form_fields');

/**
 * This function extends the functionality of get_the_excerpt by allowing
 * length and more parameters to be supplied.
 *
 * It also leaves the original state of excerpt_length and excerpt_more
 * unchanged.
 */
function get_changeme_custom_excerpt($new_length = 20, $new_more = '...') {

  $excerpt_length_callback = function() use ($new_length) {
    return $new_length;
  };

  $excerpt_more_callback = function() use ($new_more) {
    return $new_more;
  };

  add_filter('excerpt_length', $excerpt_length_callback, 999);
  add_filter('excerpt_more', $excerpt_more_callback);

  $output = get_the_excerpt();

  remove_filter('excerpt_length', $excerpt_length_callback, 999);
  remove_filter('excerpt_more', $excerpt_more_callback);

  $output = apply_filters('wptexturize', $output);
  $output = apply_filters('convert_chars', $output);
  $output = '<p>' . $output . '</p>';

  return $output;
}

function changeme_custom_excerpt($new_length = 20, $new_more = '...') {
  echo get_changeme_custom_excerpt($new_length, $new_more);
}


if ( ! function_exists( 'remove_more_link_anchor' ) ) :
  /**
   * Removes the comments anchor from the more link
   *
   * @since Change_Me 1.0
   */
  function changeme_remove_more_link_anchor($content) {
    $pattern = "/\#more-\d+\" class=\"more-link\"/";
    $replacement = "\" class=\"more-link\"";
    $content = preg_replace($pattern, $replacement, $content);
    return "$content";
  }
endif;

add_action('the_content', 'changeme_remove_more_link_anchor');
