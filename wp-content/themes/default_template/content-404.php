<?php
/**
 * @package Change_Me
 */
?>

<article class="standard-post">
  <header class="entry-header">
    <h1 class="entry-title"><?php _e( 'Sorry, Nothing Found', 'changeme' ); ?></h1>
  </header><!-- .entry-header -->

  <div class="content-container">

    <div class="entry-content full-width">
      <p>&nbsp;</p>
      <?php if (!is_search()): ?>
      <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Try using the search box at the top of our website.', 'changeme' ); ?></p>
      <?php else: ?>
      <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'changeme' ); ?></p>
      <?php endif; ?>
      <p>&nbsp;</p>
    </div>

  </div>
  <footer class="entry-footer">
  </footer>
</article><!-- #post-<?php the_ID(); ?> -->
