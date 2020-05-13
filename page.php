<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/templates/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();

$timber_post          = new Timber\Post();
$timber_posts         = Timber::get_posts('post_type = post');
$timber_categories    = Timber::get_terms('category');
$timber_tags          = Timber::get_terms('post_tag');

shuffle($timber_posts);

$context['post']       = $timber_post;
$context['posts']      = $timber_posts;
$context['categories'] = $timber_categories;
$context['tags']       = $timber_tags;
Timber::render( array( 'page-' . $timber_post->post_name . '.twig', 'page.twig' ), $context );
