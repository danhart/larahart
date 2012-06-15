<?php
/**
 * The Template for displaying all single posts.
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