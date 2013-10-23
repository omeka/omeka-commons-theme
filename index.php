<?php echo head(array('bodyid'=>'home')); ?>

<div id="intro" role="introduction">
    <h1><?php echo __('The Omeka Commons is an open access repository of content aggregated from a network of Omeka websites.'); ?></h1>
    <a href="about" class="button"><?php echo __('Learn how to use the Omeka Commons'); ?></a>
    <span class="or_search"><?php echo __('...or start searching!'); ?></span>
    <?php echo search_form(); ?>
</div>

<?php if (get_theme_option('Homepage Text')): ?>
<p><?php echo get_theme_option('Homepage Text'); ?></p>
<?php endif; ?>

<?php if($featuredSite = get_random_featured_site()): ?>
<div id="featured-site">
    <div class="placeholder image"></div>
    <h2><span class="category">Featured Site</span> <?php echo metadata($featuredSite, 'Title'); ?></h2>  
    <?php echo metadata($featuredSite, 'Description'); ?>
</div>
<?php endif; ?>

<div id="stats">
    
    <div class="items"><span class="counter"><?php echo total_records('items'); ?></span> items</div>
    
    <div class="sites"><span class="counter"><?php echo total_records('sites'); ?></span> sites</div>
    
    <span class="add-site-link"><a href="#" class="button">Add your site</a></span>

</div>

<div id="recent-items">
    <h2><?php echo __('Items recently uploaded to the Omeka Commons'); ?></h2>

    <?php
    $homepageRecentItems = (int)get_theme_option('Homepage Recent Items') ? get_theme_option('Homepage Recent Items') : '9';
    set_loop_records('items', get_recent_items($homepageRecentItems));
    if (has_loop_records('items')):
    ?>

    <div class="items-list with-images">
        <?php foreach (loop('items') as $item): ?>
        <div class="item">
            <?php $item_files = $item->getFiles(); ?>
            <?php foreach ($item_files as $item_file): ?>
                <?php $stop = 0; ?>
                <?php if ($item_file->has_derivative_image == 1): ?>
                    <div class="image" style="background-image: url('<?php echo file_display_url($item_file); ?>')"></div>
                    <?php $stop = 1; ?>
                <?php endif; ?>
                <?php if ($stop == 1) { break; } ?>
            <?php endforeach; ?>
            <?php if (count($item_files) < 1): ?>
                <div class="no image"></div>
            <?php endif; ?>

            <h2><?php echo link_to_item(); ?></h2>

            <?php if($desc = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>150))): ?>

            <div class="item-description"><?php echo $desc; ?></div>

            <?php endif; ?>

        </div>
        <?php endforeach; ?>
    </div>

    <?php else: ?>

    <p><?php echo __('No recent items available.'); ?></p>

    <?php endif; ?>

    <p><a class="view-all-items-link button" href="<?php echo html_escape(url('items')); ?>"><?php echo __('View All Items'); ?></a></p>

</div><!--end recent-items -->

<?php fire_plugin_hook('public_home', array('view' => $this)); ?>

<?php echo foot(); ?>
