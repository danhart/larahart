<?php
/**
 * The template used to display Tag Archive pages
 *
 * @package Change_Me
 * @since Change_Me 0.1
 */

get_header(); ?>

<section id="primary">
  <div id="content" role="main">

  <?php if ( have_posts() ) : ?>

    <header class="page-header">
      <h1 class="page-title"><?php
        printf( __( '%s', 'changeme' ), '<span>' . single_tag_title( '', false ) . '</span>' );
      ?></h1>

      <?php
        $tag_description = tag_description();
        if ( ! empty( $tag_description ) )
          echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta archive-meta">' . $tag_description . '</div>' );
      ?>
      
      <div class="bottom"></div>
    </header>

    <?php rewind_posts(); ?>

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

</section><!-- #primary -->

<?php get_footer(); ?>
