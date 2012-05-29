<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Change_Me
 * @since Change_Me 0.1
 */

get_header(); ?>

<div id="primary">
  <div id="content" role="main">

    <?php get_template_part( 'content', '404' ) ?>

  </div><!-- #content -->
  <?php get_sidebar(); ?>

</div><!-- #primary -->

<?php get_footer(); ?>
