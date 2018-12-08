<?php get_header(); ?>
<section class="content">
    <div class="container">
        <i class="fa fa-angle-down"></i>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; endif; ?>
    </div>
</section>
<?php get_footer(); ?>