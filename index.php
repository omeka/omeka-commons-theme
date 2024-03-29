<?php echo head(array('bodyid'=>'home')); ?>

<div id="intro" role="introduction">
    <h1><?php echo __('The Omeka Commons is an open access repository of content aggregated from a network of Omeka websites.'); ?></h1>
    <a href="about" class="button"><?php echo __('Learn how to use the Omeka Commons'); ?></a>
    <span class="or_search"><?php echo __('...or start searching!'); ?></span>
    <div id="search">
        <form id="simple-items" action="<?php echo url('items/browse'); ?>" method="GET">
            <input type="text" id="simple-items-keyword" size="40" name="search">
            <input type="submit" id="simple-items-submit" value="<?php echo __('Search Items'); ?>" name="simple-items-submit">
        </form>
        <button class="advanced-items button"><?php echo __('Advanced Options'); ?></button>
        <?php echo items_search_form(array('id' => "items-form")); ?>
    </div>
</div>

<?php if (get_theme_option('Homepage Text')): ?>
<p><?php echo get_theme_option('Homepage Text'); ?></p>
<?php endif; ?>

<div class="row">
    <div class="container">
    <div id="stats">
        
        <div class="items"><span class="counter"><?php echo total_records('items'); ?></span> items</div>
        
        <div class="sites"><span class="counter"><?php echo total_records('sites'); ?></span> sites</div>
        
        <span class="add-site-link"><a href="#" class="button">Add your site</a></span>
    
    </div>

    <?php if($featuredSite = get_random_featured_site()): ?>
    <div id="featured-site">
        <?php if ($siteLogo = sites_site_logo($featuredSite)): ?>
        <?php echo $siteLogo; ?>
        <?php endif; ?>
        <h2><span class="category">Featured Site</span> <?php echo link_to($featuredSite, 'show', metadata($featuredSite, 'Title')); ?></h2>  
        <p><?php echo metadata($featuredSite, 'Description'); ?></p>
    </div>
    <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="container">
    <?php if($featuredGroups = get_random_featured_groups(1)): ?>
    <?php $featuredGroup = $featuredGroups[0]; ?>
    <div id="featured-group">
        <div class="item-gallery">
        <?php $featuredItems = get_records('Item', array('group_id' => $featuredGroup->id, 'hasImage' => true), 9); ?>
        <?php foreach($featuredItems as $featuredItem): ?>
            <?php echo link_to_item(item_image('square_thumbnail', array('alt' => __('Image thumbnail link to %s', metadata($featuredItem, array('Dublin Core', 'Title'))), 'title' => ''), 0, $featuredItem), array(), 'show', $featuredItem); ?>
            <?php echo $featuredItem->_files; ?>
        <?php endforeach; ?>
        </div>
        <h2><span class="category">Featured Group</span> <?php echo link_to($featuredGroup, 'show', metadata($featuredGroup, 'Title')); ?></h2>  
        <p><?php echo snippet($featuredGroup->description, 0, 250); ?></p>
    </div>
    <div id="group-intro">
        <h2><?php echo __('What is a Group?'); ?></h2>
        <p><?php echo __('Groups let users work together by collecting items from across the Commons. '); ?></p>
        <p><?php echo __('Create a group, invite some users, and start adding items.'); ?></p>
        <a href="#" class="button"><?php echo __('Join or start a group'); ?></a>
    </div>
    <?php endif; ?>
    </div>
</div>

<div id="recent-items">
    <h2><?php echo __('Items recently uploaded to the Omeka Commons'); ?></h2>

    <?php
    $homepageRecentItems = (int)get_theme_option('Homepage Recent Items') ? get_theme_option('Homepage Recent Items') : get_option('per_page_public');
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

            <h2><?php echo link_to_item(snippet(metadata('item', array('Dublin Core', 'Title')), 0, 50, '...')); ?></h2>

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
