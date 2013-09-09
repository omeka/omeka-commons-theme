<!doctype html>
<html class="<?php echo get_theme_option('Style Sheet'); ?>" lang="<?php echo get_html_lang(); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>

    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <?php queue_css_url('http://fonts.googleapis.com/css?family=Raleway:400,600'); ?> 
    <?php queue_css_file('screen'); ?>
    <?php echo head_css(); ?>
    <?php echo head_js(); ?>
    
</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>

<?php fire_plugin_hook('public_body', array('view'=>$this)); ?>

    <header>
        <div class="container">
            <div class="site-title"><?php echo link_to_home_page(theme_logo()); ?></div>

            <nav>
                <?php echo public_nav_main(); ?>
            </nav>

        </div>
        
        <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
        
        <?php if (@$bodyid !== 'home'): ?>
        <?php echo search_form(); ?>
        <?php endif; ?>
    </header>
    
    <div role="main">