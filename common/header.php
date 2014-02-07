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

    <?php queue_css_url('http://fonts.googleapis.com/css?family=Lato:300,300italic|Raleway:400,600'); ?>
    <?php queue_css_file('screen'); ?>
    <?php echo head_css(); ?>

    <?php queue_js_file(array('jquery.customSelect.min', 'globals')); ?>
    <?php echo head_js(); ?>

</head>

<?php $user = (current_user()) ? ' loggedin': ' loggedout'; ?>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass . $user)); ?>

<?php fire_plugin_hook('public_body', array('view'=>$this)); ?>

    <header>
        <div class="site-title"><?php echo link_to_home_page(theme_logo()); ?></div>

        <?php echo search_form(); ?>

        <nav>
            <?php echo oc_public_nav_main(); ?>
        </nav>
        <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>

        <?php if (@$bodyid !== 'home'): ?>
          <div id="search">
              <form id="simple-items" action="<?php echo url('items/browse'); ?>" method="GET">
                  <input type="text" id="simple-items-keyword" size="40" name="search">
                  <input type="submit" id="simple-items-submit" value="<?php echo __('Search Items'); ?>" name="simple-items-submit">
              </form>
              <button class="advanced-items button"><?php echo __('Advanced Options'); ?></button>
              <?php echo items_search_form(array('id' => "items-form")); ?>
          </div>
        <?php endif; ?>
    </header>

    <div role="main">