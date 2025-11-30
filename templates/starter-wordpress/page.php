<?php
/**
 * Template for displaying pages
 *
 * @package RV_Starter
 */

get_header();
?>

<?php while (have_posts()) : the_post(); ?>

<!-- Page Header -->
<section class="py-5 bg-gradient-primary text-white">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center" data-animate>
        <h1 class="display-4 fw-bold mb-3"><?php the_title(); ?></h1>
        <?php if (has_excerpt()) : ?>
        <p class="lead"><?php the_excerpt(); ?></p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- Page Content -->
<article id="page-<?php the_ID(); ?>" <?php post_class('section-padding'); ?>>
  <div class="container">
    <div class="row">
      <div class="<?php echo is_active_sidebar('sidebar-1') ? 'col-lg-8' : 'col-lg-10'; ?> mx-auto">
        
        <?php if (has_post_thumbnail()) : ?>
        <div class="mb-4" data-animate>
          <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded shadow-lg w-100')); ?>
        </div>
        <?php endif; ?>

        <div class="page-content" data-animate>
          <?php
          the_content();

          wp_link_pages(array(
            'before' => '<div class="page-links mt-4"><span class="page-links-title">' . esc_html__('Pages:', 'rv-starter') . '</span>',
            'after'  => '</div>',
          ));
          ?>
        </div>

        <?php
        // If comments are open or there are comments, load the comment template
        if (comments_open() || get_comments_number()) :
          comments_template();
        endif;
        ?>

      </div>

      <!-- Sidebar (if active) -->
      <?php if (is_active_sidebar('sidebar-1')) : ?>
        <div class="col-lg-4">
          <?php get_sidebar(); ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
</article>

<?php endwhile; ?>

<?php
get_footer();
