<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package RV_Starter
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments
 */
function rv_starter_pingback_header() {
  if (is_singular() && pings_open()) {
    printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
  }
}
add_action('wp_head', 'rv_starter_pingback_header');

/**
 * Add custom classes to nav menu items
 */
function rv_starter_nav_menu_link_attributes($atts, $item, $args) {
  if ($args->theme_location === 'primary') {
    $atts['class'] = 'nav-link';
  }
  return $atts;
}
add_filter('nav_menu_link_attributes', 'rv_starter_nav_menu_link_attributes', 10, 3);

/**
 * Add custom classes to nav menu list items
 */
function rv_starter_nav_menu_css_class($classes, $item, $args) {
  if ($args->theme_location === 'primary') {
    $classes[] = 'nav-item';
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'rv_starter_nav_menu_css_class', 10, 3');

/**
 * Modify the comments template
 */
function rv_starter_comment_form_defaults($defaults) {
  $defaults['class_submit'] = 'btn btn-primary';
  $defaults['title_reply_before'] = '<h3 id="reply-title" class="comment-reply-title h4 mb-4">';
  $defaults['title_reply_after'] = '</h3>';
  return $defaults;
}
add_filter('comment_form_defaults', 'rv_starter_comment_form_defaults');

/**
 * Wrap comment fields in Bootstrap classes
 */
function rv_starter_comment_form_fields($fields) {
  foreach ($fields as $key => $field) {
    $fields[$key] = str_replace('<input', '<input class="form-control"', $field);
    $fields[$key] = str_replace('<textarea', '<textarea class="form-control"', $field);
  }
  return $fields;
}
add_filter('comment_form_default_fields', 'rv_starter_comment_form_fields');

/**
 * Custom search form
 */
function rv_starter_search_form($form) {
  $form = '<form role="search" method="get" class="search-form d-flex gap-2" action="' . esc_url(home_url('/')) . '">
    <input type="search" class="form-control" placeholder="' . esc_attr__('Search...', 'rv-starter') . '" value="' . get_search_query() . '" name="s" />
    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
  </form>';
  return $form;
}
add_filter('get_search_form', 'rv_starter_search_form');
