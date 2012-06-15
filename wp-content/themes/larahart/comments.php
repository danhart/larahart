<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to changeme_comment() which is
 * located in the functions.php file.
 *
 * @package Change_Me
 * @since Change_Me 0.1
 */
?>
<div id="comments">
<?php if ( post_password_required() ) : ?>
  <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'changeme' ); ?></p>
</div><!-- #comments -->
<?php
    /* Stop the rest of comments.php from being processed,
     * but don't kill the script entirely -- we still have
     * to fully load the template.
     */
    return;
  endif;
?>

<?php if ( have_comments() ) : ?>
  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
  <nav id="comment-nav-above">
    <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'changeme' ); ?></h1>
    <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'changeme' ) ); ?></div>
    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'changeme' ) ); ?></div>
  </nav>
  <?php endif; // check for comment navigation ?>

  <ol class="commentlist">
    <?php
      /* Loop through and list the comments. Tell wp_list_comments()
       * to use changeme_comment() to format the comments.
       * If you want to overload this in a child theme then you can
       * define changeme_comment() and that will be used instead.
       * See changeme_comment() in changeme/functions.php for more.
       */
      wp_list_comments( array( 'callback' => 'changeme_comment' ) );
    ?>
  </ol>

  <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
  <nav id="comment-nav-below">
    <h1 class="assistive-text section-heading"><?php _e( 'Comment navigation', 'changeme' ); ?></h1>
    <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'changeme' ) ); ?></div>
    <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'changeme' ) ); ?></div>
  </nav>
  <?php endif; // check for comment navigation ?>

<?php endif; // have_comments() ?>

<?php
  // If comments are closed and there are no comments, let's leave a little note, shall we?
  if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
?>
  <p class="nocomments"><?php _e( 'Comments are closed.', 'changeme' ); ?></p>
<?php endif; ?>

<?php comment_form( array(
  'title_reply'           => __( 'Leave a Comment' ),
  'comment_notes_before'  => '',
  'label_submit'          => __( 'submit comment' ),
  'comment_notes_after'   => '',
  'comment_field'         => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>'
) ); ?>

</div><!-- #comments -->
