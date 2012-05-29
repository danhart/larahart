<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Change_Me
 * @since Change_Me 0.1
 */

get_header(); ?>

<section id="primary">
  <div id="content" role="main">

  <?php if ( have_posts() ) : ?>

    <header class="page-header">
      <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'changeme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
      <div class="bottom"></div>
    </header>

    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'content', 'search' ); ?>

    <?php endwhile; ?>

    <?php changeme_content_nav( 'paginated-nav' ); ?>

  <?php else : ?>

    <?php get_template_part( 'content', '404' ) ?>

  <?php endif; ?>

  </div><!-- #content -->
  <?php get_sidebar(); ?>

</section><!-- #primary -->

<?php get_footer(); ?>
