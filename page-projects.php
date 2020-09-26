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

// function console_log($output, $with_script_tags = true) {
//     $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . ');';
//     if ($with_script_tags) {
//         $js_code = '<script>' . $js_code . '</script>';
//     }
//     return $js_code;
// }

function get_projects() {
  $args = array(
    'posts_per_page'  => -1,
    'orderby'         => 'title',
    'order'           => 'ASC'
  );

  $sites = get_sites(
    array('site__not_in' => array(1))
  );

  $projects = [];
  foreach ($sites as $site) {
    switch_to_blog($site->blog_id);
    $site_name = get_bloginfo('name');
    $site_projects = get_posts($args);
    foreach ($site_projects as $site_project) {
      // Get the link of this project
      $link = get_permalink($site_project->ID);
      $site_project->post_link = $link;

      // Get the thumbnail of this project
      $thumbnail = get_the_post_thumbnail_url($site_project->ID);
      $site_project->post_thumbnail = $thumbnail;

      // Get the categories of this project
      $project_categories = wp_get_object_terms($site_project->ID, "category");
      $categories = '';
      foreach ($project_categories as $project_category) {
        $categories .= $project_category->slug . ' ';
      }
      $site_project->post_categories = $categories;

      // Get the tags of this project
      $project_tags = wp_get_object_terms($site_project->ID, "post_tag");
      $tags = '';
      foreach ($project_tags as $project_tag) {
        $tags .= $project_tag->slug . ' ';
      }
      $site_project->post_tags = $tags;
      $site_project->site_name = $site_name;

      // Add to projects
      array_push($projects, $site_project);
    }
    restore_current_blog();
  }
  return $projects;
}

function get_project_categories() {
  $args = array(
    'taxonomy'    => 'category',
    'hide_empty'  => false,
    'orderby'     => 'name',
    'order'       => 'ASC',
    'parent'      => 0
  );

  $sites = get_sites(
    array('site__not_in' => array(1))
  );

  $categories = [];
  foreach ($sites as $site) {
    switch_to_blog($site->blog_id);
    $site_categories = get_terms($args);
    foreach ($site_categories as $site_category) {
      $slug = $site_category->slug;
      $name = $site_category->name;
      $categories[$slug] = $name;
    }
    restore_current_blog();
  }
  return $categories;
}

// function get_project_tags() {
//   $args = array(
//     'taxonomy' => 'post_tag',
//     'hide_empty' => false,
//     'orderby' => 'name',
//     'order' => 'ASC'
//   );

//   $sites = get_sites(
//     array('site__not_in' => array(1))
//   );

//   $tags = [];
//   foreach ($sites as $site) {
//     switch_to_blog($site->blog_id);
//     $site_tags = get_terms($args);
//     foreach ($site_tags as $site_tag) {
//       array_push($tags, $site_tag);
//     }
//     restore_current_blog();
//   }
//   return $tags;
// }

$context = Timber::context();

$timber_post        = new Timber\Post();
$timber_posts       = Timber::get_posts('post_type = post');
$timber_categories  = Timber::get_terms('category');
$timber_tags        = Timber::get_terms('post_tag');

$timber_projects           = get_projects();
$timber_project_categories = get_project_categories();
// $timber_project_tags       = get_project_tags();

// $timber_console_log = console_log($timber_all_posts);

// shuffle($timber_posts);

$context['post']        = $timber_post;
$context['posts']       = $timber_posts;
$context['console_log'] = $timber_console_log;
$context['categories']  = $timber_categories;
$context['tags']        = $timber_tags;

$context['projects']           = $timber_projects;
$context['project_categories'] = $timber_project_categories;
// $context['project_tags']       = $timber_project_tags;

Timber::render( array( 'page-' . $timber_post->post_name . '.twig', 'page.twig' ), $context );
