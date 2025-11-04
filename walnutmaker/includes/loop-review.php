<div class="wt-triggers-item" style="justify-content: center; display: block;">
    <div class="review-item">
        <div class="review-item__name">
            <?php the_field('name'); ?>
        </div>
        <div class="rating">
            <?php for ($r = 1; $r <= 5; $r++) { ?>
            <?php if (get_field('rejting') < $r) { ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path style="fill:#DADADA"
                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
            </svg>
            <?php } else { ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <path style="fill:#EC3955"
                    d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
            </svg>
            <?php } ?>
            <?php } ?>
        </div>
        <time class="review-item__date">
            <?php the_date('j.n.Y'); ?>
        </time>
        <div class="review-item__text">
            <?php the_content(); ?>
        </div>
    </div>
</div>