<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package Change_Me
 * @since Change_Me 0.1
 */

get_header(); ?>

<div id="primary">
  <div id="content" role="main">

  <?php if ( have_posts() ) : ?>

    <header class="page-header">
      <h1 class="page-title"><?php printf( single_cat_title( '', false ) ) ?></h1>

      <?php
        $category_description = category_description();
        if ( ! empty( $category_description ) )
          echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta archive-meta">' . $category_description . '</div>' );
      ?>

      <?php if (is_plugin_active('category-popular-tags/category-popular-tags.php')): ?>
      <?php the_category_popular_tags() ?>
      <?php else: ?>
      <div class="bottom"></div>
      <?php endif; ?>
    </header>

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
