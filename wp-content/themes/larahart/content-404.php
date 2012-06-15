<?php
/**
 * @package Lara_Hart
 */
?>

<h1 class="entry-title"><?php _e( 'Sorry, Nothing Found', 'larahart' ); ?></h1>

<div class="entry-content full-width">
  <p>&nbsp;</p>
  <?php if (!is_search()): ?>
  <p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Try using the search box at the top of our website.', 'larahart' ); ?></p>
  <?php else: ?>
  <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'larahart' ); ?></p>
  <?php endif; ?>
  <p>&nbsp;</p>
</div>
