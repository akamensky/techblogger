<div class="content">
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <span class="content-meta">/ <?php the_date(); ?> / <?php printf(_nx('1 comment', '%1$s comments', get_comments_number(), ''), number_format_i18n(get_comments_number())); ?> /</span>
    <?php the_excerpt(); ?>
</div><!-- /.blog-post -->
