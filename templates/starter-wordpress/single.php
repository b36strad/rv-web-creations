<?php
/**
 * Template for displaying single posts
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
      <div class="col-lg-10 mx-auto text-center" data-animate>
        <h1 class="display-4 fw-bold mb-3"><?php the_title(); ?></h1>
        <div class="d-flex justify-content-center align-items-center gap-3 flex-wrap">
          <span>
            <i class="bi bi-person me-1"></i>
            <?php the_author_posts_link(); ?>
          </span>
          <span>
            <i class="bi bi-calendar me-1"></i>
            <?php echo get_the_date(); ?>
          </span>
          <span>
            <i class="bi bi-folder me-1"></i>
            <?php the_category(', '); ?>
          </span>
          <?php if (get_comments_number() > 0) : ?>
          <span>
            <i class="bi bi-chat me-1"></i>
            <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
          </span>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Post Content -->
<article id="post-<?php the_ID(); ?>" <?php post_class('section-padding'); ?>>
  <div class="container">
    <div class="row">
      
      <!-- Main Content -->
      <div class="<?php echo is_active_sidebar('sidebar-1') ? 'col-lg-8' : 'col-lg-10'; ?> mx-auto">
        
        <?php if (has_post_thumbnail()) : ?>
        <div class="mb-4" data-animate>
          <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded shadow-lg w-100')); ?>
        </div>
        <?php endif; ?>

        <div class="post-content" data-animate>
          <?php
          the_content();

          wp_link_pages(array(
            'before' => '<div class="page-links mt-4"><span class="page-links-title">' . esc_html__('Pages:', 'rv-starter') . '</span>',
            'after'  => '</div>',
          ));
          ?>
        </div>

        <?php if (get_the_tags()) : ?>
        <div class="post-tags mt-4" data-animate>
          <i class="bi bi-tags me-2"></i>
          <?php the_tags('', ', ', ''); ?>
        </div>
        <?php endif; ?>

        <!-- Author Bio -->
        <?php if (get_the_author_meta('description')) : ?>
        <div class="author-bio card border-0 shadow-sm mt-5" data-animate>
          <div class="card-body p-4">
            <div class="d-flex align-items-start gap-3">
              <div class="flex-shrink-0">
                <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', array('class' => 'rounded-circle')); ?>
              </div>
              <div>
                <h5 class="mb-2"><?php the_author(); ?></h5>
                <p class="text-muted mb-0"><?php the_author_meta('description'); ?></p>
              </div>
            </div>
          </div>
        </div>
        <?php endif; ?>

        <!-- Post Navigation -->
        <div class="post-navigation mt-5" data-animate>
          <div class="row g-3">
            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            ?>
            
            <?php if ($prev_post) : ?>
            <div class="col-md-6">
              <a href="<?php echo get_permalink($prev_post); ?>" class="card border-0 shadow-sm text-decoration-none card-hover h-100">
                <div class="card-body">
                  <small class="text-muted">
                    <i class="bi bi-arrow-left me-1"></i>
                    <?php esc_html_e('Previous Post', 'rv-starter'); ?>
                  </small>
                  <h6 class="mt-2 mb-0"><?php echo get_the_title($prev_post); ?></h6>
                </div>
              </a>
            </div>
            <?php endif; ?>
            
            <?php if ($next_post) : ?>
            <div class="col-md-6">
              <a href="<?php echo get_permalink($next_post); ?>" class="card border-0 shadow-sm text-decoration-none card-hover h-100">
                <div class="card-body text-md-end">
                  <small class="text-muted">
                    <?php esc_html_e('Next Post', 'rv-starter'); ?>
                    <i class="bi bi-arrow-right ms-1"></i>
                  </small>
                  <h6 class="mt-2 mb-0"><?php echo get_the_title($next_post); ?></h6>
                </div>
              </a>
            </div>
            <?php endif; ?>
          </div>
        </div>

        <!-- Comments -->
        <?php
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
