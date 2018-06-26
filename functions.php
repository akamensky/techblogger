<?php

// Add scripts and stylesheets
function techblogger_scripts() {
    wp_enqueue_style('bootstrap-css', get_template_directory_uri().'/assets/css/bootstrap.min.css');
	wp_enqueue_style('blog', get_template_directory_uri().'/assets/css/style.css');
	wp_enqueue_script('jquery', get_template_directory_uri().'/assets/js/jquery-3.3.1.slim.min.js', array(), null, true);
	wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/assets/js/bootstrap.bundle.min.js', array(), null, true);
}

// Add Google Fonts
function techblogger_google_fonts() {
	wp_register_style('OpenSans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800');
	wp_enqueue_style('OpenSans');
}

add_action('wp_enqueue_scripts', 'techblogger_scripts');
// add_action('wp_print_styles', 'techblogger_google_fonts');

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
