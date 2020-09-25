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

function get_agencies() {
  $sites = get_sites(
    array('site__not_in' => array(1))
  );

  $agencies = [];
  foreach ($sites as $site) {
    switch_to_blog($site->blog_id);
    $site_agency_id = get_option('page_on_front');
    $site_agency = get_page($site_agency_id);

    // Get link to agency page
    $link = get_permalink($site_agency->ID);
    $site_agency->post_link = $link;

    // Get the thumbnail of this project
    $thumbnail = get_the_post_thumbnail_url($site_agency->ID);
    $site_agency->post_thumbnail = $thumbnail;

    restore_current_blog();

    // Add to projects
    array_push($agencies, $site_agency);
  }
  return $agencies;
}


$context = Timber::context();

$timber_post          = new Timber\Post();
$timber_posts         = Timber::get_posts('post_type = post');
$timber_categories    = Timber::get_terms('category');
$timber_tags          = Timber::get_terms('post_tag');

$timber_agencies = get_agencies();

// shuffle($timber_posts);

$context['post']       = $timber_post;
$context['posts']      = $timber_posts;
$context['categories'] = $timber_categories;
$context['tags']       = $timber_tags;

$context['agencies']   = $timber_agencies;


Timber::render( array( 'page-' . $timber_post->post_name . '.twig', 'page.twig' ), $context );
