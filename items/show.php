<?php $itemTitle = metadata('item', array('Dublin Core', 'Title')); ?>
<?php queue_js_file('jquery.modal.min'); ?>
<?php queue_js_string("
    jQuery(document).ready(function(){
        jQuery('.launch-add-item').modal({
            trigger: '.launch-add-item',
            olay:'div.overlay',             // id or class of overlay
            animationSpeed: 400,            // speed of overlay in milliseconds | default=400
            moveModalSpeed: 'slow',         // speed of modal movement when window is resized | slow or fast | default=false
            background: '000000',           // hexidecimal color code - DONT USE #
            opacity: 0.5,                   // opacity of modal |  0 - 1 | default = 0.8
            openOnLoad: false,              // open modal on page load | true or false | default=false
            docClose: true,                 // click document to close | true or false | default=true    
            closeByEscape: true,            // close modal by escape key | true or false | default=true
            moveOnScroll: true,             // move modal when window is scrolled | true or false | default=false
            resizeWindow: true,             // move modal when window is resized | true or false | default=false
            close:'.close-button'               // id or class of close button
        });
    });
"); ?>
<?php echo head(array('title' => $itemTitle, 'bodyclass' => 'items show')); ?>

<h1><?php echo $itemTitle; ?></h1>

<div id="sidebar">
    <!-- The following returns all of the files associated with an item. -->
    <?php if (metadata('item', 'has files')): ?>
    <div id="itemfiles" class="element">
        <div class="element-text"><?php echo files_for_item(); ?></div>
    </div>
    <?php endif; ?>
    
    <nav>
    <ul class="item-pagination navigation">
        <li id="previous-item" class="previous"><?php echo link_to_previous_item_show(); ?></li>
        <li id="next-item" class="next"><?php echo link_to_next_item_show(); ?></li>
    </ul>
    </nav>
    
    <?php if($user = current_user() && plugin_is_active('Groups')): ?>
        <?php $userGroups = groups_groups_for_user(); ?>
        <?php $itemUserGroups = array(); ?>
        <?php foreach($userGroups as $userGroup): ?>
            <?php if ($userGroup->hasItem($item)): ?>
            <?php $itemUserGroups[] = $userGroup; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        
        <?php $emptyCheck = (count($itemUserGroups) < 1) ? 'empty' : ''; ?>
        <div class='groups-item-status <?php echo $emptyCheck; ?>'>
            <h3><?php echo __('%s is in your groups:', $itemTitle); ?></h3>
            <ul id='item-user-groups'>
            <?php foreach($itemUserGroups as $group): ?>
                <?php $groupId = $group->id; ?>
                <?php if ($group->hasItem($item)): ?>
                <li><?php echo link_to($group, 'show', $group->title); ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
            <h3><?php echo __('%s is not in any of your groups.', $itemTitle); ?></h3>
            <button class="launch-add-item"><?php echo __('Add item to your groups', $itemTitle); ?></button>
        </div>

        <div class="overlay"></div>
        <div class="groups-add-item modal">
            <div class="modal-header">
                <a href="#" class="close-button">Close Me</a>
                <h3><?php echo __('Add %s to Your Groups', $itemTitle); ?></h3>
            </div>
            <div class="modal-content">
                <p class="explanation"><?php echo __('Once you add an item to your group, only a group administrator can remove the item. If you want to later remove this item from a group, make sure you have sufficient privileges.'); ?></p>
                <ul id="user-groups">
                    <?php foreach ($userGroups as $userGroup): ?>
                        <?php $userGroupId = $userGroup->id; ?>
                        <?php if ($userGroup->hasItem($item)): ?>
                            <li class="groups-item-exists"><?php echo $userGroup->title; ?> <span class="added"><?php echo __('(already added)'); ?></span></li>
                        <?php else: ?>
                            <li id="groups-id-<?php echo $userGroupId; ?>" class="groups-add-item"><a href="#"><?php echo $userGroup->title; ?></a><input type="checkbox" val="0" name="select-group-<?php echo $userGroupId; ?>">
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
                <button class="add-to-groups close-button"><?php echo __('Select Groups'); ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<div id="primary">

<?php echo all_element_texts('item'); ?>

<!-- If the item belongs to a collection, the following creates a link to that collection. -->
<?php if (metadata('item', 'Collection Name')): ?>
<div id="collection" class="element">
    <h3><?php echo __('Collection'); ?></h3>
    <div class="element-text"><p><?php echo link_to_collection_for_item(); ?></p></div>
</div>
<?php endif; ?>

<!-- The following prints a list of all tags associated with the item -->
<?php if (metadata('item', 'has tags')): ?>
<div id="item-tags" class="element">
    <h3><?php echo __('Tags'); ?></h3>
    <div class="element-text"><?php echo tag_string('item'); ?></div>
</div>
<?php endif;?>

<!-- The following prints a citation for this item. -->
<div id="item-citation" class="element">
    <h3><?php echo __('Citation'); ?></h3>
    <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
</div>

<div id="item-output-formats" class="element">
    <h3><?php echo __('Output Formats'); ?></h3>
    <div class="element-text"><?php echo output_format_list(); ?></div>
</div>

<?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>

</div>

<?php echo foot(); ?>
