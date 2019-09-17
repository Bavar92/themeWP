<?php get_header(); ?>
<section class="content">
    <div class="container">
        <?php
        if ('' !== get_post()->post_content) { ?>
            <div class="wysiwyg">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; endif; ?>
            </div>
        <?php } ?>
    </div>
</section>
<?php get_footer(); ?>