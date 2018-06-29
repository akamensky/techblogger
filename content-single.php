<div class="content">
    <h1><?php the_title(); ?></h1>
    <span class="content-meta">/ <?php the_date(); ?> / <?php printf(_nx('1 comment', '%1$s comments', get_comments_number(), ''), number_format_i18n(get_comments_number())); ?> /</span>
    <?php the_content(); ?>
</div><!-- /.blog-post -->
