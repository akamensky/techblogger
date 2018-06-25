<?php get_header(); ?>
    <div class="row content-row">
        <div class="col-lg-2">
        </div>
        <div class="col-lg-7 top-padded content-col">
            <?php
                if (have_posts()) : while (have_posts()) : the_post();
                    get_template_part('content', get_post_format());
                endwhile; endif;
            ?>
            <nav>
            	<ul class="pager">
            	    <?php if(get_previous_posts_link()): ?>
            		<li class="btn btn-info"><?php previous_posts_link('Newer'); ?></li>
            		<?php endif; ?>
            	    <?php if(get_next_posts_link()): ?>
            		<li class="btn btn-info"><?php next_posts_link( 'Earlier' ); ?></li>
            		<?php endif; ?>
            	</ul>
            </nav>
        </div>
        <?php get_sidebar(); ?>
    </div>
<?php get_footer(); ?>
