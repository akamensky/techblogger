<?php get_header(); ?>
    <!-- MAIN -->
    <div class="container content">
        <div class="page">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post(); ?>
                    <h1 class="post-title"><?php the_title(); ?></h1>
                    <?php
                    the_content();
                    ?>
                <?php endwhile;
            endif;
            ?>
        </div>
    <!-- /MAIN -->
<?php get_footer(); ?>