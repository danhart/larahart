<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Lara_Hart
 * @since Lara_Hart 0.1
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?> itemscope itemtype="http://schema.org/Blog">
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?> itemscope itemtype="http://schema.org/Blog" xmlns:fb="http://ogp.me/ns/fb#">
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?> itemscope itemtype="http://schema.org/Blog" xmlns:fb="http://ogp.me/ns/fb#">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> itemscope itemtype="http://schema.org/Blog" xmlns:fb="http://ogp.me/ns/fb#">
<!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title><?php
  /*
   * Print the <title> tag based on what is being viewed.
   */
  global $page, $paged;

  wp_title( '|', true, 'right' );

  // Add the blog name.
  bloginfo( 'name' );

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) )
    echo " | $site_description";

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 )
    echo ' | ' . sprintf( __( 'Page %s', 'larahart' ), max( $paged, $page ) );

  ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/reset.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_directory' ); ?>/main.css" />
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <?php wp_enqueue_script("jquery"); ?>
    <?php wp_head(); ?>

    <script src="<?php echo get_template_directory_uri(); ?>/js/blog.scroll_anchors.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/blog.placeholder.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/application.js" type="text/javascript"></script>
  </head>

  <body <?php body_class(); ?> <?php body_id(); ?>>
    <div id="page" class="hfeed">
    <?php do_action( 'before' ); ?>
      <div id="header">
          <h1 id="logo">
            <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
              <img src="<?php bloginfo('template_directory'); ?>/images/laralogo.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php esc_attr( bloginfo( 'description' ) ); ?>" />
            </a>
          </h1>
        <div id="nav">
          <?php wp_nav_menu( array(
            'theme_location' => 'primary'
          ) ); ?>

        </div>
      </div>
      <div id="mainbanner"></div>
      <div id="content">
