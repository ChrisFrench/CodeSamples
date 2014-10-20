<?php if (!empty($roles)) { ?>
<div class="">
	<?php $current = \Joomla\Utilities\ArrayHelper::getColumn( (array) $flash->old('roles'), 'id' ); ?>
    <?php foreach ($roles as $one) { ?>
    <div class="checkbox">
        <label>
            <input type="checkbox" name="roles[]" class="icheck-input" value="<?php echo $one->_id; ?>" <?php if (in_array($one->_id, $current)) { echo "checked='checked'"; } ?>>
            <?php echo $one->name;  ?>
        </label>
    </div>
    <br>
    <?php } ?> 
    
</div>
<?php } ?>