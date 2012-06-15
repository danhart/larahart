<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Change_Me
 * @since Change_Me 0.1
 */

get_header(); ?>

<section id="primary">
  <div id="content" role="main">

  <?php if ( have_posts() ) : ?>

    <header class="page-header">
      <h1 class="page-title">
        <?php
          if ( is_day() ) :
            echo get_the_date();
          elseif ( is_month() ) :
            echo get_the_date( 'F Y' );
          elseif ( is_year() ) :
            echo get_the_date( 'Y' );
          else :
            _e( 'Archives', 'changeme' );
          endif;
        ?>
      </h1>
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
