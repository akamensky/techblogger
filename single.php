<?php get_header(); ?>
    <div class="row content-row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-7 top-padded content-col">
            <?php
                if (have_posts()) : while (have_posts()) : the_post();
                    get_template_part('content-single', get_post_format());
                endwhile; endif;

                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
            ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>
