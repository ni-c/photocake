<div class="lenses form">
<?php echo $this->Form->create('Lense'); ?>
	<fieldset>
		<legend><?php echo __('Edit Lense'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Lense.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Lense.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Lenses'), array('action' => 'index')); ?></li>
	</ul>
</div>
