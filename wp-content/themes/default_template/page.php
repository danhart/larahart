<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Change_Me
 * @since Change_Me 0.1
 */

get_header(); ?>

<div id="primary">
  <div id="content" role="main">

    <?php while ( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'content' ); ?>

    <?php endwhile; // end of the loop. ?>

  </div><!-- #content -->
  <?php get_sidebar(); ?>

</div><!-- #primary -->

<?php get_footer(); ?>
