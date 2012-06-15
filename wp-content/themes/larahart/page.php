<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Lara_Hart
 * @since Lara_Hart 0.1
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part( 'content' ); ?>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>
