<?php
/**
 * Template part for displaying posts in blog listing
 *
 * @package RV_Starter
 */

if (!defined('ABSPATH')) {
  exit;
}
?>

<div class="col-md-6" data-animate>
  <article id="post-<?php the_ID(); ?>" <?php post_class('card h-100 border-0 shadow-sm card-hover'); ?>>
    
    <?php if (has_post_thumbnail()) : ?>
    <a href="<?php the_permalink(); ?>">
      <?php the_post_thumbnail('medium_large', array('class' => 'card-img-top')); ?>
    </a>
    <?php endif; ?>
    
    <div class="card-body">
      
      <!-- Categories -->
      <?php if (has_category()) : ?>
      <div class="mb-2">
        <?php
        $categories = get_the_category();
        if (!empty($categories)) {
          echo '<span class="badge bg-primary">' . esc_html($categories[0]->name) . '</span>';
        }
        ?>
      </div>
      <?php endif; ?>
      
      <!-- Title -->
      <h2 class="h5 mb-3">
        <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
          <?php the_title(); ?>
        </a>
      </h2>
      
      <!-- Meta -->
      <div class="d-flex align-items-center gap-3 mb-3 small text-muted">
        <span>
          <i class="bi bi-person me-1"></i>
          <?php the_author(); ?>
        </span>
        <span>
          <i class="bi bi-calendar me-1"></i>
          <?php echo get_the_date(); ?>
        </span>
      </div>
      
      <!-- Excerpt -->
      <p class="text-muted mb-3">
        <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
      </p>
      
      <!-- Read More -->
      <a href="<?php the_permalink(); ?>" class="btn btn-primary">
        <?php esc_html_e('Read More', 'rv-starter'); ?> <i class="bi bi-arrow-right ms-1"></i>
      </a>
      
    </div>
  </article>
</div>
