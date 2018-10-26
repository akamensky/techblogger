<?php get_header(); ?>
<!-- MAIN -->
<div class="container content">
    <div class="post">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                get_template_part('content-single', get_post_format());
            }
        }

        if (comments_open() || get_comments_number()) {
            comments_template();
        }
        ?>
    </div>
</div>
<!-- /MAIN -->
<?php get_footer(); ?>
