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

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    return $js_code;
}

function get_all_posts() {
  $sites = get_sites(
    array('site__not_in' => array(1))
  );
  $all_posts = [];
  foreach ($sites as $site) {
    switch_to_blog($site->blog_id);
    $site_posts = get_posts();
    foreach ($site_posts as $site_post) {
      array_push($all_posts, $site_post);
    }
    restore_current_blog();
  }
  return $all_posts;
}

$context = Timber::context();

$timber_post          = new Timber\Post();
$timber_posts         = Timber::get_posts('post_type = post');
$timber_categories    = Timber::get_terms('category');
$timber_tags          = Timber::get_terms('post_tag');

$timber_all_posts     = get_all_posts();
$timber_console_log   = console_log($timber_all_posts);

shuffle($timber_posts);

$context['post']       = $timber_post;
$context['posts']      = $timber_posts;
$context['all_posts']  = $timber_all_posts;
$context['console_log']  = $timber_console_log;
$context['categories'] = $timber_categories;
$context['tags']       = $timber_tags;
Timber::render( array( 'page-' . $timber_post->post_name . '.twig', 'page.twig' ), $context );
