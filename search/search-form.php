<?php echo $this->form('search-form', $options['form_attributes']); ?>
    <fieldset id="query-types">
        <?php echo $this->formSelect('query_type', $filters['query_type'], null, $query_types, ''); ?>
    </fieldset>
    <?php echo $this->formText('query', $filters['query'], array('placeholder' => 'Search the whole site')); ?>
    <fieldset id="record-types">
        <?php foreach ($record_types as $key => $value): ?>
            <a href="#" class="record-type"><?php echo $this->formCheckbox('record_types[]', $key, in_array($key, $filters['record_types']) ? array('checked' => true, 'id' => 'record_types-' . $key, 'tabindex' => '-1') : array('tabindex' => '-1')); ?> <?php echo $value; ?></a>
        <?php endforeach; ?>
    </fieldset>
    <button type="submit" value="Search"><span class="icon-search"></span><span class="screen-reader-text"><?php echo __('Search'); ?></span></button>
</form>