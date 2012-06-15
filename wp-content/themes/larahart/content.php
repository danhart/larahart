<?php
/**
 * @package Change_Me
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('standard-post'); ?>>
  <header class="entry-header">
    <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'changeme' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

    <?php if ( 'post' == get_post_type() ): ?>
    <div class="entry-meta">
      <?php changeme_posted_on(); ?>
    </div><!-- .entry-meta -->
    <?php endif; ?>

    <?php edit_post_link( __( 'Edit', 'changeme' ), '<span class="edit-link">', '</span>' ); ?>
  </header><!-- .entry-header -->

  <div class="content-container">
    <div class="entry-content">
      <?php if (has_post_thumbnail()): ?>
      <a class="entry-featured-image" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'changeme' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail('large-featured-image'); ?></a>
      <?php endif ?>
      <?php the_content( __( 'read more', 'changeme' ) ); ?>
    </div>

    <aside>
      <?php if ( comments_open() && !is_page() || ( '0' != get_comments_number() && ! comments_open() ) ): ?>
      <span class="comments-link"><?php comments_popup_link( __( 'No comments', 'changeme' ), __( '1 comment', 'changeme' ), __( '% comments', 'changeme' ) ); ?></span>
      <?php endif; ?>

      <?php
      $tags_list = get_the_tag_list('<ul class="entry-tags"><li>','</li><li>','</li></ul>'); 
      if ( $tags_list ):
      ?>
      <h3>Tags</h3>
      <?php echo $tags_list; ?>
      <?php endif; // End if $tags_list ?>

    </aside>

    <?php if ( is_single() ) : ?>

      <?php changeme_social_media('inline clearfix') ?>

      <?php
        // If comments are open or we have at least one comment, load up the comment template
        if ( comments_open() || '0' != get_comments_number() )
          comments_template( '', true );
      ?>

      <?php 
      if (is_plugin_active('yet-another-related-posts-plugin/yarpp.php')) {
        if (related_posts_exist()) related_posts();
      }
      ?>
      <?php changeme_content_nav( 'nav-below' ); ?>

    <?php endif ?>
  </div>
  <footer class="entry-footer">
  </footer>
</article><!-- #post-<?php the_ID(); ?> -->
