<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package Change_Me
 * @since Change_Me 0.1
 */

get_header(); ?>

<section id="primary">
  <div id="content" role="main">

  <?php if ( have_posts() ) : ?>

    <?php
      /* Queue the first post, that way we know
       * what author we're dealing with (if that is the case).
       *
       * We reset this later so we can run the loop
       * properly with a call to rewind_posts().
       */
      the_post();
    ?>

    <header class="page-header">
      <h1 class="page-title author"><?php printf( __( '%s', 'changeme' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
      <div class="bottom"></div>
    </header>

    <?php
      /* Since we called the_post() above, we need to
       * rewind the loop back to the beginning that way
       * we can run the loop properly, in full.
       */
      rewind_posts();
    ?>

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
