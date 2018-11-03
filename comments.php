<?php
if (post_password_required()) {
	return;
} ?>
<!-- COMMENTS -->
<div class="comments-container">
    <?php if (have_comments()): ?>
    <h3 class="comments-title"><?php printf(_nx('1 comment', '%1$s comments', get_comments_number(), 'comments title'), number_format_i18n(get_comments_number()), get_the_title()); ?></h3>
    <ul class="comment-list">
        <?php
            wp_list_comments(array(
                'callback' => 'better_comments'
            ));
        ?>
    </ul>
    <?php else: ?>
    <h3 class="comments-title">No comments yet</h3>
    <?php endif; ?>
    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
    <h4><?php _e('Commenting on this article not available'); ?></h4>
    <?php endif; ?>
    <?php
    comment_form(
        array(
            'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
            'title_reply_after' => '</h4>',
            'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true" required="required" placeholder="Leave your comment"></textarea></p>',
            'title_reply' => '',
            'title_reply_to' => '',
        )
    );
    ?>
</div>
<!-- /COMMENTS -->