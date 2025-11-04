<?php
  $post_general_settings = get_field('post_general_settings');
  $do_full_thumbnail = isset($post_general_settings['do_full_thumbnail']) ? $post_general_settings['do_full_thumbnail'] : false;
  $thumbnail_classes = $do_full_thumbnail == 1 ? ['wt-single-thumbnail--full'] : [''];
?>

<div class="wt-single-thumbnail <?= join(' ', $thumbnail_classes) ?>" ><?php the_post_thumbnail('full'); ?></div>
<div class="wt-single-content wt-styles"><?php the_content(); ?></div>
