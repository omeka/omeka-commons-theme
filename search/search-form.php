<div id="search">
<div class="search tab current"><?php echo __('Site-wide Search'); ?></div>
<div class="items tab"><?php echo __('Advanced Items-only Search'); ?></div>
<?php echo $this->form('search-form', $options['form_attributes']); ?>
    <?php echo $this->formText('query', $filters['query']); ?>
    <?php echo $this->formSubmit(null, $options['submit_value']); ?>
    <a href="#" class="advanced-site-options button"><?php echo __('Advanced Options'); ?></a>
    <fieldset id="advanced-form">
        <fieldset id="query-types">
            <p><?php echo __('Search using this query type:'); ?></p>
            <div class="inputs">
                <?php echo $this->formRadio('query_type', $filters['query_type'], null, $query_types); ?>
            </div>
        </fieldset>
        <?php if ($record_types): ?>
        <fieldset id="record-types">
            <p><?php echo __('Search only these record types:'); ?></p>
            <div class="inputs">
            <?php foreach ($record_types as $key => $value): ?>
                <?php echo $this->formCheckbox('record_types[]', $key, in_array($key, $filters['record_types']) ? array('checked' => true, 'id' => 'record_types-' . $key) : null); ?> <?php echo $value; ?><br>
            <?php endforeach; ?>
            </div>
        </fieldset>
        <?php elseif (is_admin_theme()): ?>
            <p><a href="<?php echo url('settings/edit-search'); ?>"><?php echo __('Go to search settings to select record types to use.'); ?></a></p>
        <?php endif; ?>
    </fieldset>
</form>
<?php echo items_search_form(array('id' => "items-form")); ?>
</div>