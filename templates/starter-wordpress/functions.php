<?php
/**
 * RV Starter Theme Functions
 * 
 * Theme setup, custom functions, and WordPress hooks
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function rv_starter_setup() {
  // Add default posts and comments RSS feed links to head
  add_theme_support('automatic-feed-links');

  // Let WordPress manage the document title
  add_theme_support('title-tag');

  // Enable support for Post Thumbnails on posts and pages
  add_theme_support('post-thumbnails');
  
  // Set default thumbnail size
  set_post_thumbnail_size(800, 600, true);
  
  // Add additional image sizes
  add_image_size('rv-featured', 1920, 1080, true);
  add_image_size('rv-thumbnail', 400, 300, true);

  // Register navigation menus
  register_nav_menus(array(
    'primary' => esc_html__('Primary Menu', 'rv-starter'),
    'footer' => esc_html__('Footer Menu', 'rv-starter'),
  ));

  // Switch default core markup to output valid HTML5
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'style',
    'script',
  ));

  // Add theme support for selective refresh for widgets
  add_theme_support('customize-selective-refresh-widgets');

  // Add support for core custom logo
  add_theme_support('custom-logo', array(
    'height'      => 100,
    'width'       => 200,
    'flex-width'  => true,
    'flex-height' => true,
  ));

  // Add support for Block Styles
  add_theme_support('wp-block-styles');

  // Add support for full and wide align images
  add_theme_support('align-wide');

  // Add support for editor styles
  add_theme_support('editor-styles');
  
  // Add support for responsive embedded content
  add_theme_support('responsive-embeds');
}
add_action('after_setup_theme', 'rv_starter_setup');

/**
 * Set the content width in pixels
 */
function rv_starter_content_width() {
  $GLOBALS['content_width'] = apply_filters('rv_starter_content_width', 1140);
}
add_action('after_setup_theme', 'rv_starter_content_width', 0);

/**
 * Enqueue scripts and styles
 */
function rv_starter_scripts() {
  // Bootstrap CSS from CDN
  wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css', array(), '5.3.0');
  
  // Bootstrap Icons
  wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css', array(), '1.11.0');
  
  // Base template CSS
  wp_enqueue_style('rv-base-variables', get_template_directory_uri() . '/css/variables.css', array('bootstrap'), '1.0.0');
  wp_enqueue_style('rv-base-utilities', get_template_directory_uri() . '/css/utilities.css', array('rv-base-variables'), '1.0.0');
  
  // Theme stylesheet (style.css - required by WordPress)
  wp_enqueue_style('rv-starter-style', get_stylesheet_uri(), array('rv-base-utilities'), '1.0.0');
  
  // Custom theme styles
  wp_enqueue_style('rv-starter-custom', get_template_directory_uri() . '/css/styles.css', array('rv-starter-style'), '1.0.0');
  
  // Bootstrap JS from CDN
  wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', array(), '5.3.0', true);
  
  // Base common JS
  wp_enqueue_script('rv-common', get_template_directory_uri() . '/js/common.js', array('bootstrap'), '1.0.0', true);
  
  // Theme custom JS
  wp_enqueue_script('rv-starter-main', get_template_directory_uri() . '/js/main.js', array('rv-common'), '1.0.0', true);
  
  // Comment reply script
  if (is_singular() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}
add_action('wp_enqueue_scripts', 'rv_starter_scripts');

/**
 * Register widget areas
 */
function rv_starter_widgets_init() {
  register_sidebar(array(
    'name'          => esc_html__('Sidebar', 'rv-starter'),
    'id'            => 'sidebar-1',
    'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'rv-starter'),
    'before_widget' => '<section id="%1$s" class="widget card mb-4 border-0 shadow-sm %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title card-header bg-white fw-bold">',
    'after_title'   => '</h3><div class="card-body">',
  ));

  register_sidebar(array(
    'name'          => esc_html__('Footer 1', 'rv-starter'),
    'id'            => 'footer-1',
    'description'   => esc_html__('Add widgets here to appear in footer column 1.', 'rv-starter'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h6 class="widget-title mb-3">',
    'after_title'   => '</h6>',
  ));

  register_sidebar(array(
    'name'          => esc_html__('Footer 2', 'rv-starter'),
    'id'            => 'footer-2',
    'description'   => esc_html__('Add widgets here to appear in footer column 2.', 'rv-starter'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h6 class="widget-title mb-3">',
    'after_title'   => '</h6>',
  ));

  register_sidebar(array(
    'name'          => esc_html__('Footer 3', 'rv-starter'),
    'id'            => 'footer-3',
    'description'   => esc_html__('Add widgets here to appear in footer column 3.', 'rv-starter'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h6 class="widget-title mb-3">',
    'after_title'   => '</h6>',
  ));
}
add_action('widgets_init', 'rv_starter_widgets_init');

/**
 * Custom template tags for this theme
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Walker for Bootstrap Navigation
 */
require get_template_directory() . '/inc/class-bootstrap-nav-walker.php';

/**
 * Excerpt length
 */
function rv_starter_excerpt_length($length) {
  return 30;
}
add_filter('excerpt_length', 'rv_starter_excerpt_length', 999);

/**
 * Excerpt more
 */
function rv_starter_excerpt_more($more) {
  return '...';
}
add_filter('excerpt_more', 'rv_starter_excerpt_more');

/**
 * Add custom body classes
 */
function rv_starter_body_classes($classes) {
  // Add a class if sidebar is active
  if (!is_active_sidebar('sidebar-1')) {
    $classes[] = 'no-sidebar';
  }

  // Add class for single posts
  if (is_singular()) {
    $classes[] = 'singular';
  }

  return $classes;
}
add_filter('body_class', 'rv_starter_body_classes');
