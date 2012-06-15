<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Change_Me
 * @since Change_Me 0.1
 */
?>

    </div><!-- #main -->

    <footer id="colophon" role="contentinfo">

      <div id="footer-widgets" class="widget-area" role="complementary">

        <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
          <?php dynamic_sidebar( 'sidebar-2' ); ?>
        <?php endif; ?>

      </div>

      <p id="copyright">Copyright &copy; 2006 - 2012 Notonthehighstreet Enterprises Limited</p>
    </footer><!-- #colophon -->
  </div><!-- #page -->

  <?php wp_footer(); ?>

  <script src="<?php echo get_template_directory_uri(); ?>/js/social-media.js" type="text/javascript"></script>

  </body>
</html>
