<?php
/**
 * Make excerpt ellipses prettier
 */
function new_excerpt_more($more) {
    return '... <a class="read-more" href="' . get_permalink( get_the_ID() ) . '">Continue reading</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

/**
 * Add classes to navigation links
 */
function techblogger_previous_link_attributes() {
    return 'class="pagination-item older"';
}
function techblogger_next_link_attributes() {
    return 'class="pagination-item newer"';
}
add_filter('previous_posts_link_attributes', 'techblogger_previous_link_attributes');
add_filter('next_posts_link_attributes', 'techblogger_next_link_attributes');

/**
 * Get menu object by location
 *
 * @param array args
 * @return array|false Menu object if found one and false otherwise
 */
function techblogger_get_menu_by_location($args = array()) {
    $defaults = array(
        'location' => '',
        'tpl' => '<a href="%2$s">%1$s</a>',
    );
    $args = wp_parse_args($args, $defaults);

    if ($args['location'] == "") {
        return false;
    }

    $locations = get_nav_menu_locations();

    if (isset($locations[$args['location']])) {
        $menu_obj = wp_get_nav_menu_object($locations[$args['location']]);
    }

    if (!isset($menu_obj)) {
        return false;
    }

    if (!is_wp_error($menu_obj)) {
        $items = wp_get_nav_menu_items(
            $menu_obj->term_id,
            array(
                'update_post_term_cache' => false
            )
        );

        $items_list = array();

        foreach ((array)$items as $item) {
            $processed_item = sprintf($args['tpl'], $item->title, $item->url);
            array_push($items_list, $processed_item);
        }

        return $items_list;
    }

    return false;
}

/**
 * Register menus
 */
function register_menus() {
    register_nav_menu('sidebar-menu',__('Sidebar Menu'));
}
add_action('init', 'register_menus');


/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
    add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');

/**
 * Filter function used to remove the tinymce emoji plugin.
 *
 * @param array $plugins
 * @return array Difference between the two arrays
 */
function disable_emojis_tinymce($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch($urls, $relation_type) {
    if ('dns-prefetch' == $relation_type) {
        /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

        $urls = array_diff($urls, array($emoji_svg_url));
    }
    return $urls;
}

// WordPress Titles
add_theme_support('title-tag');

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'Sidebar',
        'before_widget' => '<div class = "sidebar-widget">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    )
);

add_action('admin_menu', 'techblogger_settings_menu');

function techblogger_settings_menu() {
	add_theme_page("Tech Blogger theme settings", "Tech Blogger", 'edit_theme_options', 'techblogger-settings', 'techblogger_settings_page');
}

function techblogger_settings_page() { ?>
	<div class="wrap">
		<h1>Theme Settings</h1>
		<form method="post" action="" name="check-update">
            <input type="hidden" id="update-theme" name="update-theme" value="1">
			<input class="button" type="submit" value="Update Theme">
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST) && isset($_POST['update-theme']) && $_POST['update-theme'] == 1) {
                print("<p>Updating:</p>");
                $_oldcwd = getcwd();
                chdir(get_template_directory());
                $output = shell_exec('git pull origin master');
                chdir($_oldcwd);
                print("<pre>");
                print($output);
                print("</pre>");
            } ?>
		</form>
	</div>
<?php }

function techblogger_settings_page_setup() {
	add_settings_section('section', 'Updates', 'theme_settings_updates', 'theme-options');
}

function better_comments($comment, $args, $depth) {
    global $post;
    $author_id = $post->post_author;
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type):
        case 'pingback':
        case 'trackback':
            // Display trackbacks differently than normal comments. ?>
            <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
            <div class="pingback-entry"><span class="pingback-heading"><?php esc_html_e( 'Pingback:', 'twenties' ); ?></span> <?php comment_author_link(); ?></div>
            <?php
            break;
        default :
            // Proceed with normal comments. ?>
        <li id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" <?php comment_class('clr'); ?>>
                <div class="comment-details clr">
                    <header class="comment-meta">
                        <cite class="fn"><?php comment_author_link(); ?></cite>
                        <span class="comment-date">on <?php printf( '<time datetime="%1$s">%2$s</time>', get_comment_time('c'), get_comment_date()); ?> <?php comment_time(); ?></span><!-- .comment-date -->
                        <span class="comment-link"><?php printf( '<a href="%1$s">#</a>', esc_url(get_comment_link($comment->comment_ID))); ?></span>
                    </header><!-- .comment-meta -->
                    <?php if ( '0' == $comment->comment_approved ) : ?><p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'twenties' ); ?></p><?php endif; ?>
                    <div class="comment-content entry clr"><?php comment_text(); ?></div><!-- .comment-content -->
                </div><!-- .comment-details -->
            </article><!-- #comment-## -->
            <?php
            break;
    endswitch; // End comment_type check.
}

// Add placeholder for Name and Email
function modify_comment_form_fields($fields){
    $fields['author'] = '<input id="author" placeholder="Your name" name="author" type="text" value="" required="required" aria-required="true" />';
    $fields['email'] = '<input id="email" placeholder="Your email" name="email" type="email" value="" required="required" aria-required="true" />';
    $fields['url'] = '<input id="url" name="url" placeholder="Website" type="url" value="" />';
    return $fields;
}
add_filter('comment_form_default_fields','modify_comment_form_fields');

function remove_jquery_from_frontend( ){
    wp_dequeue_script('jquery');
    wp_deregister_script('jquery');
    wp_dequeue_script('jquery-migrate');
    wp_deregister_script('jquery-migrate');
}
add_filter('wp_enqueue_scripts', 'remove_jquery_from_frontend', PHP_INT_MAX);
