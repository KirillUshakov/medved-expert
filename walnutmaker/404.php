<?php
get_header();
$posts = new WP_Query(array('category_name' => 'services', 'posts_per_page' => 4, 'order' => 'ASC'));
?>
<div class="wt-404">
    <div class="container">
        <div class="wt-404-image">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/svg/404.svg" alt="404">
        </div>
        <div class="wt-404-content">
            <h1>404</h1>
            <p>Кажется вы попали не туда, куда нужно, так как страницы больше не существует.</p>
            <a href="/" class="btn btn-default">На главную</a>
        </div>
    </div>
</div>
<?php if ($posts->have_posts()) { ?>
    <section class="wt-items wt-items-color-blue wt-items-substrate-white wt-items-posts wt-items-404">
        <div class="container">
            <h3 class="wt-items-title">Возможно, Вас заинтересуют эти услуги</h3>
            <ul class="wt-items-row content-left">
                <?php while ($posts->have_posts()) { ?>
                    <?php $posts->the_post(); ?>
                    <li class="wt-items-col col-sm-6 col-md-3">
                        <a class="wt-items-item" href="<?php the_permalink(); ?>">
                            <div class="wt-items-thumbnail"><?php the_post_thumbnail('adaptive'); ?></div>
                            <div class="wt-items-content">
                                <div class="wt-items-content-name">
                                    <?php echo get_field('shortname') ? get_field('shortname') : get_the_title(); ?>
                                </div>
                                <div class="wt-items-content-excerpt"><?php the_advanced_excerpt(); ?></div>
                            </div>
                        </a>
                    </li>
                <?php } ?>
                <?php wp_reset_postdata(); ?>
            </ul>
        </div>
    </section>
<?php } ?>
<?php get_footer(); ?>
