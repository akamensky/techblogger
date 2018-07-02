<?php if ( post_password_required() ) {
	return;
} ?>
            <div class="comments-container">
                <?php if ( have_comments() ): ?>
                <h4 class="comments-title"><?php printf( _nx( '1 comment', '%1$s comments', get_comments_number(), 'comments title'), number_format_i18n( get_comments_number() ), get_the_title() ); ?></h4>
                <ul class="comment-list">
                    <?php
                        wp_list_comments( array(
                            'short_ping'  => true,
                            'avatar_size' => 50,
                        ) );
                        $_comments = get_comments();
                        print_r($_comments);
                    ?>
                </ul>
                <?php else: ?>
                <h4 class="comments-title">No comments yet</h4>
                <?php endif; ?>
                <?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
                <h4><?php _e( 'Comments are closed.' ); ?></h4>
                <?php endif; ?>
                <?php comment_form(array('title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">', 'title_reply_after' => '</h4>')); ?>
            </div>
