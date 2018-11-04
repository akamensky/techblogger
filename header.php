<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="stylesheet" href="/wp-content/themes/techblogger/assets/css/style.css">
    <script async="async" type="text/javascript" src="/wp-content/themes/techblogger/assets/js/combined.min.js"></script>
    <?php wp_head(); ?>
</head>
<body class="theme-base-0d">
    <input type="checkbox" class="sidebar-checkbox" id="sidebar-checkbox">
    <div class="sidebar" id="sidebar">
        <div class="sidebar-item">
            <p>A blog by software engineer and food enthusiast.</p>
        </div>
        <nav class="sidebar-nav">
<!-- MENU -->
<?php
    $menu_items = techblogger_get_menu_by_location(array(
        'location' => 'sidebar-menu',
        'tpl' => '<a class="sidebar-nav-item" href="%2$s">%1$s</a>',
    ));
    if ($menu_items) {
        foreach ((array)$menu_items as $item) {
            print $item . "\r\n";
        }
    }
?>
<!-- /MENU -->
        </nav>
        <div class="sidebar-item">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Sidebar") ) : ?>
        <?php endif;?>
        </div>
        <div class="sidebar-item">
            <p>&copy; <?php echo date("Y"); ?>. All rights reserved.</p>
        </div>
    </div>
    <div class="wrap">
        <div class="masthead">
            <div class="container">
                <h3 class="masthead-title">
                    <a href="/" title="Home"><?php echo get_bloginfo( 'name' ); ?></a>
                    <small><?php echo get_bloginfo( 'description' ); ?></small>
                </h3>
            </div>
        </div>
