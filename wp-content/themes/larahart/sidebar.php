<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Change_Me
 * @since Change_Me 0.1
 */
?>
<div id="main-sidebar" class="widget-area" role="complementary">
  <?php do_action( 'before_sidebar' ); ?>
  <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

  <aside id="search" class="widget widget_search">
    <?php get_search_form(); ?>
  </aside>

  <aside id="archives" class="widget">
    <h1 class="widget-title"><?php _e( 'Archives', 'changeme' ); ?></h1>
    <ul>
      <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
    </ul>
  </aside>

  <aside id="meta" class="widget">
    <h1 class="widget-title"><?php _e( 'Meta', 'changeme' ); ?></h1>
    <ul>
      <?php wp_register(); ?>
      <aside><?php wp_loginout(); ?></aside>
      <?php wp_meta(); ?>
    </ul>
  </aside>

  <?php endif; // end sidebar widget area ?>
</div>

