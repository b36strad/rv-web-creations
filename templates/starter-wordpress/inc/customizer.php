<?php
/**
 * Theme Customizer
 *
 * @package RV_Starter
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer
 */
function rv_starter_customize_register($wp_customize) {
  $wp_customize->get_setting('blogname')->transport = 'postMessage';
  $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

  if (isset($wp_customize->selective_refresh)) {
    $wp_customize->selective_refresh->add_partial(
      'blogname',
      array(
        'selector'        => '.navbar-brand',
        'render_callback' => 'rv_starter_customize_partial_blogname',
      )
    );
    $wp_customize->selective_refresh->add_partial(
      'blogdescription',
      array(
        'selector'        => '.site-description',
        'render_callback' => 'rv_starter_customize_partial_blogdescription',
      )
    );
  }

  // Add theme color section
  $wp_customize->add_section('rv_starter_colors', array(
    'title'    => __('Theme Colors', 'rv-starter'),
    'priority' => 40,
  ));

  // Primary color
  $wp_customize->add_setting('rv_starter_primary_color', array(
    'default'           => '#007bff',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'refresh',
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'rv_starter_primary_color', array(
    'label'    => __('Primary Color', 'rv-starter'),
    'section'  => 'rv_starter_colors',
    'settings' => 'rv_starter_primary_color',
  )));

  // Accent color
  $wp_customize->add_setting('rv_starter_accent_color', array(
    'default'           => '#28a745',
    'sanitize_callback' => 'sanitize_hex_color',
    'transport'         => 'refresh',
  ));

  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'rv_starter_accent_color', array(
    'label'    => __('Accent Color', 'rv-starter'),
    'section'  => 'rv_starter_colors',
    'settings' => 'rv_starter_accent_color',
  )));
}
add_action('customize_register', 'rv_starter_customize_register');

/**
 * Render the site title for the selective refresh partial
 */
function rv_starter_customize_partial_blogname() {
  bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial
 */
function rv_starter_customize_partial_blogdescription() {
  bloginfo('description');
}

/**
 * Output custom colors as CSS variables
 */
function rv_starter_customizer_css() {
  $primary_color = get_theme_mod('rv_starter_primary_color', '#007bff');
  $accent_color = get_theme_mod('rv_starter_accent_color', '#28a745');
  
  ?>
  <style type="text/css">
    :root {
      --color-primary: <?php echo esc_attr($primary_color); ?>;
      --color-accent: <?php echo esc_attr($accent_color); ?>;
    }
  </style>
  <?php
}
add_action('wp_head', 'rv_starter_customizer_css');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously
 */
function rv_starter_customize_preview_js() {
  wp_enqueue_script('rv-starter-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), '1.0.0', true);
}
add_action('customize_preview_init', 'rv_starter_customize_preview_js');
