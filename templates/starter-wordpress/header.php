<?php
/**
 * The header for our theme
 *
 * @package RV_Starter
 */

if (!defined('ABSPATH')) {
  exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?php echo esc_url(home_url('/')); ?>">
      <?php
      // Display custom logo if set
      if (has_custom_logo()) {
        the_custom_logo();
      } else {
        // Display site name
        echo '<span class="text-primary">' . esc_html(get_bloginfo('name')) . '</span>';
      }
      ?>
    </a>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'rv-starter'); ?>">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNav">
      <?php
      // Display primary navigation menu
      wp_nav_menu(array(
        'theme_location'  => 'primary',
        'container'       => false,
        'menu_class'      => 'navbar-nav ms-auto',
        'fallback_cb'     => '__return_false',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth'           => 2,
        'walker'          => new Bootstrap_Nav_Walker(),
      ));
      ?>
    </div>
  </div>
</nav>
