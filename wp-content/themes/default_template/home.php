<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Change_Me
 * @since Change_Me 0.1
 */

get_header(); ?>

<?php $options = get_option( 'changeme_theme_options' ); ?>

<?php if ($options['featuredpostsenabled']) get_template_part( 'featuredposts' ); ?>
<?php if ($options['latestpostsenabled']) get_template_part( 'latestposts' ); ?>

<div id="primary">
  <div id="content" role="main">

    <?php if ( have_posts() ) : ?>

    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>

    <?php
    /* Include the Post-Format-specific template for the content.
     * If you want to overload this in a child theme then include a file
     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
     */
    get_template_part( 'content', get_post_format() );
    ?>

    <?php endwhile; ?>

    <?php changeme_content_nav( 'paginated-nav' ); ?>

    <?php else : ?>

      <?php get_template_part( 'content', '404' ) ?>

    <?php endif; ?>

  </div><!-- #content -->
  <?php get_sidebar(); ?>

</div><!-- #primary -->

<?php get_footer(); ?>
