<?php
/**
 * Template part for displaying a message when no posts are found
 *
 * @package RV_Starter
 */

if (!defined('ABSPATH')) {
  exit;
}
?>

<div class="col-12">
  <div class="card border-0 shadow-sm text-center p-5">
    <div class="card-body">
      <i class="bi bi-search fs-1 text-muted mb-3 d-block"></i>
      
      <?php if (is_home() && current_user_can('publish_posts')) : ?>
        
        <h2 class="h4 mb-3"><?php esc_html_e('Ready to publish your first post?', 'rv-starter'); ?></h2>
        <p class="text-muted mb-4">
          <?php esc_html_e('Get started by adding some content to your blog.', 'rv-starter'); ?>
        </p>
        <a href="<?php echo esc_url(admin_url('post-new.php')); ?>" class="btn btn-primary">
          <?php esc_html_e('Add New Post', 'rv-starter'); ?>
        </a>
        
      <?php elseif (is_search()) : ?>
        
        <h2 class="h4 mb-3"><?php esc_html_e('No Results Found', 'rv-starter'); ?></h2>
        <p class="text-muted mb-4">
          <?php esc_html_e('Sorry, no posts matched your search criteria. Please try again with different keywords.', 'rv-starter'); ?>
        </p>
        <?php get_search_form(); ?>
        
      <?php else : ?>
        
        <h2 class="h4 mb-3"><?php esc_html_e('Nothing Found', 'rv-starter'); ?></h2>
        <p class="text-muted mb-4">
          <?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'rv-starter'); ?>
        </p>
        <?php get_search_form(); ?>
        
      <?php endif; ?>
      
    </div>
  </div>
</div>
