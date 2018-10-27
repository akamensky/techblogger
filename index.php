<?php get_header(); ?>
<!-- MAIN -->
<div class="container content">
    <div class="posts">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_template_part('content', get_post_format());
            }
        }
        ?>
    </div>
<div class="pagination">
    <?php if (get_previous_posts_link()):
        previous_posts_link('Newer');
    else:
        print '<span class="pagination-item newer">Newer</span>';
    endif;?>
    <?php if(get_next_posts_link()):
        next_posts_link('Older');
    else:
        print '<span class="pagination-item older">Older</span>';
    endif;?>
</div>
</div>
<!-- /MAIN -->
<?php get_footer(); ?>