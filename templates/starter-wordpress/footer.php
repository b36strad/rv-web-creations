<?php
/**
 * The template for displaying the footer
 *
 * @package RV_Starter
 */

if (!defined('ABSPATH')) {
  exit;
}
?>

<!-- Footer -->
<footer class="bg-dark text-white py-5">
  <div class="container">
    <div class="row g-4">
      
      <!-- Footer Column 1 -->
      <div class="col-lg-4">
        <?php if (is_active_sidebar('footer-1')) : ?>
          <?php dynamic_sidebar('footer-1'); ?>
        <?php else : ?>
          <h5 class="mb-3"><?php bloginfo('name'); ?></h5>
          <p class="text-white-50">
            <?php
            $description = get_bloginfo('description', 'display');
            if ($description || is_customize_preview()) {
              echo esc_html($description);
            }
            ?>
          </p>
        <?php endif; ?>
      </div>
      
      <!-- Footer Column 2 -->
      <div class="col-lg-2 col-md-4">
        <?php if (is_active_sidebar('footer-2')) : ?>
          <?php dynamic_sidebar('footer-2'); ?>
        <?php else : ?>
          <h6 class="mb-3"><?php esc_html_e('Quick Links', 'rv-starter'); ?></h6>
          <?php
          wp_nav_menu(array(
            'theme_location' => 'footer',
            'container'      => false,
            'menu_class'     => 'list-unstyled',
            'fallback_cb'    => false,
            'depth'          => 1,
            'link_before'    => '<span class="text-white-50 text-decoration-none">',
            'link_after'     => '</span>',
          ));
          ?>
        <?php endif; ?>
      </div>
      
      <!-- Footer Column 3 -->
      <div class="col-lg-3 col-md-4">
        <?php if (is_active_sidebar('footer-3')) : ?>
          <?php dynamic_sidebar('footer-3'); ?>
        <?php else : ?>
          <h6 class="mb-3"><?php esc_html_e('Contact Info', 'rv-starter'); ?></h6>
          <ul class="list-unstyled text-white-50">
            <li class="mb-2">
              <i class="bi bi-envelope me-2"></i>
              <a href="mailto:<?php echo esc_attr(get_option('admin_email')); ?>" class="text-white-50 text-decoration-none">
                <?php echo esc_html(get_option('admin_email')); ?>
              </a>
            </li>
          </ul>
        <?php endif; ?>
      </div>
      
      <!-- Footer Column 4 -->
      <div class="col-lg-3 col-md-4">
        <h6 class="mb-3"><?php esc_html_e('Recent Posts', 'rv-starter'); ?></h6>
        <ul class="list-unstyled text-white-50">
          <?php
          $recent_posts = wp_get_recent_posts(array(
            'numberposts' => 3,
            'post_status' => 'publish'
          ));
          foreach ($recent_posts as $post) :
          ?>
            <li class="mb-2">
              <a href="<?php echo esc_url(get_permalink($post['ID'])); ?>" class="text-white-50 text-decoration-none">
                <?php echo esc_html($post['post_title']); ?>
              </a>
            </li>
          <?php endforeach; wp_reset_query(); ?>
        </ul>
      </div>
      
    </div>
    
    <hr class="my-4 border-secondary">
    
    <div class="row">
      <div class="col-md-6 text-center text-md-start">
        <p class="mb-0 text-white-50">
          <?php
          /* translators: 1: Current year, 2: Site name */
          printf(
            esc_html__('&copy; %1$s %2$s. All rights reserved.', 'rv-starter'),
            date('Y'),
            get_bloginfo('name')
          );
          ?>
        </p>
      </div>
      <div class="col-md-6 text-center text-md-end">
        <a href="<?php echo esc_url(get_privacy_policy_url()); ?>" class="text-white-50 text-decoration-none me-3">
          <?php esc_html_e('Privacy Policy', 'rv-starter'); ?>
        </a>
        <a href="#" class="text-white-50 text-decoration-none">
          <?php esc_html_e('Terms of Service', 'rv-starter'); ?>
        </a>
      </div>
    </div>
  </div>
</footer>

<!-- Back to Top Button -->
<a href="#" class="back-to-top position-fixed bottom-0 end-0 m-4 btn btn-primary rounded-circle no-print" style="width: 50px; height: 50px; display: none;">
  <i class="bi bi-arrow-up"></i>
</a>

<?php wp_footer(); ?>

</body>
</html>
