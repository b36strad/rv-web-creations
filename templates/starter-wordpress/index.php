<?php
/**
 * The main template file (home/blog listing)
 *
 * @package RV_Starter
 */

get_header();
?>

<!-- Page Header -->
<section class="py-5 bg-gradient-primary text-white">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 mx-auto text-center" data-animate>
        <h1 class="display-4 fw-bold mb-3">
          <?php
          if (is_home() && !is_front_page()) {
            single_post_title();
          } else {
            esc_html_e('Our Blog', 'rv-starter');
          }
          ?>
        </h1>
        <p class="lead">
          <?php bloginfo('description'); ?>
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Blog Content -->
<section class="section-padding">
  <div class="container">
    <div class="row g-4">
      
      <!-- Main Content -->
      <div class="<?php echo is_active_sidebar('sidebar-1') ? 'col-lg-8' : 'col-lg-12'; ?>">
        
        <?php if (have_posts()) : ?>
          
          <div class="row g-4">
            <?php
            while (have_posts()) :
              the_post();
              get_template_part('template-parts/content', get_post_format());
            endwhile;
            ?>
          </div>

          <!-- Pagination -->
          <div class="mt-5">
            <?php
            the_posts_pagination(array(
              'mid_size'  => 2,
              'prev_text' => '<i class="bi bi-arrow-left me-2"></i>' . esc_html__('Previous', 'rv-starter'),
              'next_text' => esc_html__('Next', 'rv-starter') . '<i class="bi bi-arrow-right ms-2"></i>',
              'class'     => 'pagination justify-content-center',
            ));
            ?>
          </div>

        <?php else : ?>
          
          <?php get_template_part('template-parts/content', 'none'); ?>

        <?php endif; ?>

      </div>

      <!-- Sidebar -->
      <?php if (is_active_sidebar('sidebar-1')) : ?>
        <div class="col-lg-4">
          <?php get_sidebar(); ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>

<?php
get_footer();
