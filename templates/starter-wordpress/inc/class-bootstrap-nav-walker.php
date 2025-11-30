<?php
/**
 * Bootstrap 5 Navigation Walker
 * 
 * Makes WordPress menus work with Bootstrap 5 navbar
 *
 * @package RV_Starter
 */

if (!defined('ABSPATH')) {
  exit;
}

class Bootstrap_Nav_Walker extends Walker_Nav_Menu {
  
  /**
   * Starts the list before the elements are added
   */
  public function start_lvl(&$output, $depth = 0, $args = null) {
    if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
      $t = '';
      $n = '';
    } else {
      $t = "\t";
      $n = "\n";
    }
    $indent = str_repeat($t, $depth);
    
    // Bootstrap dropdown menu
    $classes = array('dropdown-menu');
    $class_names = join(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
    $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
    
    $output .= "{$n}{$indent}<ul$class_names>{$n}";
  }

  /**
   * Starts the element output
   */
  public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
    if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
      $t = '';
      $n = '';
    } else {
      $t = "\t";
      $n = "\n";
    }
    $indent = ($depth) ? str_repeat($t, $depth) : '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;
    $classes[] = 'nav-item';
    
    // Check if item has children
    if (in_array('menu-item-has-children', $classes)) {
      $classes[] = 'dropdown';
    }

    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
    $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
    $id = $id ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li' . $id . $class_names . '>';

    $atts = array();
    $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
    $atts['target'] = !empty($item->target) ? $item->target : '';
    if ('_blank' === $item->target && empty($item->xfn)) {
      $atts['rel'] = 'noopener';
    } else {
      $atts['rel'] = $item->xfn;
    }
    $atts['href'] = !empty($item->url) ? $item->url : '';
    $atts['aria-current'] = $item->current ? 'page' : '';

    // Add Bootstrap classes
    $atts['class'] = 'nav-link';
    
    // Add dropdown toggle classes if item has children
    if (in_array('menu-item-has-children', $classes)) {
      $atts['class'] .= ' dropdown-toggle';
      $atts['data-bs-toggle'] = 'dropdown';
      $atts['aria-expanded'] = 'false';
    }
    
    // Add active class to current item
    if (in_array('current-menu-item', $classes) || in_array('current-menu-ancestor', $classes)) {
      $atts['class'] .= ' active';
    }

    $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

    $attributes = '';
    foreach ($atts as $attr => $value) {
      if (is_scalar($value) && '' !== $value && false !== $value) {
        $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
        $attributes .= ' ' . $attr . '="' . $value . '"';
      }
    }

    $item_output = isset($args->before) ? $args->before : '';
    $item_output .= '<a' . $attributes . '>';
    $item_output .= isset($args->link_before) ? $args->link_before : '';
    $item_output .= apply_filters('the_title', $item->title, $item->ID);
    $item_output .= isset($args->link_after) ? $args->link_after : '';
    $item_output .= '</a>';
    $item_output .= isset($args->after) ? $args->after : '';

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }

  /**
   * Traverse elements to create list from elements
   */
  public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
    if (!$element) {
      return;
    }

    $id_field = $this->db_fields['id'];

    // Display this element
    if (is_object($args[0])) {
      $args[0]->has_children = !empty($children_elements[$element->$id_field]);
    }

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
  }

  /**
   * Menu Fallback
   */
  public static function fallback($args) {
    if (current_user_can('edit_theme_options')) {
      $args['link_before'] = '<span class="nav-link">';
      $args['link_after'] = '</span>';
      
      $output = '<ul class="navbar-nav ms-auto">';
      $output .= '<li class="nav-item">';
      $output .= '<a href="' . admin_url('nav-menus.php') . '" class="nav-link">' . __('Add a menu', 'rv-starter') . '</a>';
      $output .= '</li>';
      $output .= '</ul>';
      
      echo $output;
    }
  }
}
