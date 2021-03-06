<?php
/*
Template Name: Left-side Image
*/

/**
 * @package Lara_Hart
 * @since Lara_Hart 0.1
 */

get_header(); ?>

<div id="leftimage"><?php the_post_thumbnail('aside-image'); ?></div>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part( 'content' ); ?>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
