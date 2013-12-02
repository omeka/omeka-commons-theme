<?php
queue_js_file('items');
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse grid'));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<?php echo item_search_filters(); ?>

<?php echo pagination_links(); ?>

<?php if ($total_results > 0): ?>
<div class="views">
    <span class="grid">Grid view</span>
    <span class="list">List view</span>
</div>
<?php else: ?>
<div id="no-results">
    <p><?php echo __('Your query returned no results.'); ?></p>
</div>
<?php endif; ?>

<div class="items">
<?php foreach (loop('items') as $item): ?>
<div class="item hentry">
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

    <h2><?php echo link_to_item(snippet(metadata('item', array('Dublin Core', 'Title')), 0, 40, '...'), array('class'=>'permalink')); ?></h2>
    <div class="item-meta">

    <?php if ($description = metadata('item', array('Dublin Core', 'Description'), array('snippet'=>250))): ?>
    <div class="item-description">
        <?php echo $description; ?>
    </div>
    <?php endif; ?>

    <?php if (metadata('item', 'has tags')): ?>
    <div class="tags"><p><strong><?php echo __('Tags'); ?>:</strong>
        <?php echo tag_string('items'); ?></p>
    </div>
    <?php endif; ?>

    <?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>

    </div><!-- end class="item-meta" -->
</div><!-- end class="item hentry" -->
<?php endforeach; ?>
</div>

<?php echo pagination_links(); ?>

<div id="outputs">
    <span class="outputs-label"><?php echo __('Output Formats'); ?></span>
    <?php echo output_format_list(false); ?>
</div>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
